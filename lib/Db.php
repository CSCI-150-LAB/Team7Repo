<?php

class Db {
	private $conn;
	private $trackingModels = false;
	private $trackedModelsExistences = [];

    public function __construct($host, $user, $pass, $dbname) {
        $this->conn = new mysqli($host, $user, $pass, $dbname);

        if ($this->conn->connect_errno) {
            throw new Exception('MySQL connect failed: ' . $this->conn->connect_errno);
		}
		else {
			$this->conn->autocommit(true);
		}
    }

    public function __destruct() {
        $this->conn->close();
    }

	/**
	 * Executes a MySQL query returning the result
	 *
	 * @param string $sql
	 * @param mixed ...$args
	 * @return mixed
	 */
    public function query($sql, ...$args) {
		$numericNdx = 0;
		$args = array_reduce($args, function($carry, $item) use (&$numericNdx) {
			if (is_array($item)) {
				foreach ($item as $key => $val) {
					if (is_numeric($key)) {
						$carry[$numericNdx++] = $val;
					}
					else {
						$carry[$key] = $val;
					}
				}
			}
			else {
				$carry[$numericNdx++] = $item;
			}

			return $carry;
		}, []);

		foreach ($args as $key => $val) {
			switch (gettype($val)) {
				case 'int':
				case 'integer':
				case 'double':
				case 'NULL':
					continue 2;	// These are fine as is
				case 'boolean':
					$args[$key] = $val ? 1 : 0;
					break;
				case 'object':
					if (method_exists($val, '__toString')) {
						$val = $val->__toString();
					}
					else {
						throw new Exception('Object cannot be used as a parameter in a query');
					}
					// Passthru intended
				case 'string':
					$args[$key] = "'" . $this->conn->real_escape_string($val) . "'";
					break;
				default:
					throw new Exception(gettype($val) . ' cannot be used as a parameter in a query');
			}
		}
		
		$sql = trim($sql);
		$sql = self::insertSqlParams($sql, $args);

		$result = $this->conn->query($sql);

        if ($result === true) {
			if (stripos($sql, 'INSERT INTO') === 0) {
				return $this->conn->insert_id;
			}

			return true;
        }
        elseif ($result instanceof mysqli_result) {
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }

            return $rows;
        }
        else {
            return false;
        }
    }

	/**
	 * Gets the last error from the MySQL connection
	 *
	 * @return string
	 */
    public function getLastError() {
        return $this->conn->error;
	}
	
	/**
	 * Begins a transaction on the MySQL connection
	 *
	 * @return void
	 */
	public function startTransaction() {
		$this->conn->autocommit(false);
		$this->trackingModels = true;
	}

	/**
	 * Aborts the transaction and rollsback the database changes
	 *
	 * @return void
	 */
	public function abortTransaction() {
		$this->conn->rollback();
		$this->conn->autocommit(true);
		$this->trackedModelsExistences = [];
		$this->trackingModels = false;
	}

	/**
	 * Commits all the database changes to the MySQL server
	 *
	 * @return void
	 */
	public function commitTransaction() {
		$this->conn->commit();
		$this->conn->autocommit(true);
		foreach ($this->trackedModelsExistences as $existenc) {
			$existenc[0] = $existenc[1];
		}
		$this->trackedModelsExistences = [];
		$this->trackingModels = false;
	}

	/**
	 * Returns whether or not the database is in transaction mode
	 *
	 * @return boolean
	 */
	public function isTrackingModels() {
		return $this->trackingModels;
	}

	/**
	 * Allows the database to update a model's "exist" flag when a transaction is committed
	 *
	 * @param boolean $exist
	 * @param boolean $futureValue
	 * @return void
	 */
	public function trackModel(&$exist, $futureValue) {
		if ($this->trackingModels) {
			$this->trackedModelsExistences[] = [&$exist, $futureValue];
		}
	}

	private static function insertSqlParams($sql, $params) {
		// Scan query for any set keywords
		$lastNdx = 0;
		$strLen = strlen($sql);
		$result = '';
		$currentToken = '';
		$inSet = false;
		
		for ($i = 0; $i < $strLen; $i++) {
			if (ctype_space($sql[$i])) {
				if (strcasecmp($currentToken, 'SET') == 0) {
					$result .= self::insertSqlParamsHelper(substr($sql, $lastNdx, $i - $lastNdx), $params, false);
					$lastNdx = $i;
					$inSet = true;
				}
				elseif (strcasecmp($currentToken, 'WHERE') == 0) {
					$result .= self::insertSqlParamsHelper(substr($sql, $lastNdx, $i - $lastNdx), $params, $inSet);
					$lastNdx = $i;
					$inSet = false;
				}

				$currentToken = '';
			}
			elseif ($sql[$i] == '"' || $sql[$i] == "'") {
				// Read past the string
				$quoteChar = $sql[$i];
				$i++;
				$escaping = false;
				while ($sql[$i] != $quoteChar || $escaping) {
					$char = $sql[$i];
					$i++;
					if ($i == $strLen) {
						throw new Exception('Bad SQL query');
					}

					if ($escaping) {
						$escaping = false;
					}
					else {
						if ($char == '\\') {
							$escaping = true;
						}
					}
				}
				$i++;
			}
			else {
				$currentToken .= $sql[$i];
			}
		}

		// Grab last piece
		$result .= self::insertSqlParamsHelper(substr($sql, $lastNdx), $params, $inSet);
		return $result;
	}

	private static function insertSqlParamsHelper($sql, $params, $inSet) {
		return preg_replace_callback('/(?:(!?=|<>)\\s*)?([\'"]?):([a-z0-9_-]+):\\2/i', function($matches) use ($params, $inSet) {
			if (isset($params[$matches[3]])) {
				return ltrim($matches[1] . ' ') . $params[$matches[3]];
			}

			if ($inSet) {
				return ltrim($matches[1] . ' ') . 'NULL';
			}

			return empty($matches[1])
				? 'NULL'
				: ($matches[1] == '='
					? 'IS NULL'
					: 'IS NOT NULL');
		}, $sql);
	}
}