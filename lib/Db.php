<?php

class Db {
	private static $debugIgnorePath = APP_ROOT . DIRECTORY_SEPARATOR . 'lib';

	private $connInfo = false;
	private $conn = null;
	private $trackingModels = false;
	private $trackedModelCallbacks = [];
	private $lastQuery = '';
	private $logging = false;

	public function __construct(...$conInfo) {
		$this->connInfo = $conInfo;
	}

	public function __destruct() {
		if ($this->conn) {
			$this->conn->close();
		}
	}

	/**
	 * Connects to the remote MySQL server
	 * 
	 * @return void
	 * @throws Exception
	 */
	private function connect() {
		if (!$this->conn) {
			$this->conn = new mysqli(...$this->connInfo);
			$this->connInfo = false;

			if ($this->conn->connect_errno) {
				throw new Exception('MySQL connect failed: ' . $this->conn->connect_errno);
			}
			else {
				$this->conn->autocommit(true);
			}
		}
	}

	/**
	 * Executes a MySQL query returning the result
	 *
	 * @param string $sql
	 * @param mixed ...$args
	 * @return mixed
	 */
	public function query($sql, ...$args) {
		$this->connect();
		
		if (count($args) == 1 && is_array($args[0])) {
			$args = $args[0];
		}

		foreach ($args as $key => $val) {
			list($val) = $this->prepareSqlParam($val);
			$args[$key] = $val;
		}
		
		$sql = trim($sql);
		$sql = self::insertSqlParams($sql, $args);
		$this->lastQuery = $sql;
		if ($this->logging) {
			$this->logQuery($sql);
		}

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
	 * Gets the last query that was executed
	 *
	 * @return string
	 */
	public function getLastQuery() {
		return $this->lastQuery;
	}

	/**
	 * Signals the Db to record all run queries
	 * 
	 * @return void
	 */
	public function startTrackingQueries() {
		$this->logging = true;
	}

	public function logQuery($sql) {
		$record = [
			'sql' => $sql
		];

		foreach (debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS) as $entry) {
			if (strpos($entry['file'], Db::$debugIgnorePath) === false) {
				$record['file'] = $entry['file'];
				$record['line'] = $entry['line'];
				break;
			}
		}

		if (!isset($_SESSION['__db_log'])) {
			$_SESSION['__db_log'] = [];
		}
		$_SESSION['__db_log'][] = $record;
	}

	/**
	 * Signals the Db to stop recording all run queries
	 * 
	 * @return void
	 */
	public function stopTrackingQueries() {
		$this->logging = false;
	}

	/**
	 * Gets all the queries that have run in order
	 * 
	 * @return string[]|false
	 */
	public function getAllQueries() {
		if (isset($_SESSION['__db_log'])) {
			$log = $_SESSION['__db_log'];
			unset($_SESSION['__db_log']);
			return $log;
		}

		return [];
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
		$this->trackingModels = false;

		$type = (string)DbTrackTypeEnum::ABORTED();
		if (isset($this->trackedModelCallbacks[$type])) {
			foreach ($this->trackedModelCallbacks[$type] as $cb) {
				$cb();
			}
		}
		
		$this->trackedModelCallbacks = [];
	}

	/**
	 * Commits all the database changes to the MySQL server
	 *
	 * @return void
	 */
	public function commitTransaction() {
		$this->conn->commit();
		$this->conn->autocommit(true);
		$this->trackingModels = false;

		$type = (string)DbTrackTypeEnum::COMMITTED();
		if (isset($this->trackedModelCallbacks[$type])) {
			foreach ($this->trackedModelCallbacks[$type] as $cb) {
				$cb();
			}
		}

		$this->trackedModelCallbacks = [];
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
	 * Allows the database to update a model when a transaction is committed or aborted
	 *
	 * @param DbTrackTypeEnum $type
	 * @param callable $cb
	 * @return void
	 */
	public function trackModel(DbTrackTypeEnum $type, callable $cb) {
		$type = (string)$type;

		if ($this->trackingModels) {
			if (!isset($this->trackedModelCallbacks[$type])) {
				$this->trackedModelCallbacks[$type] = [];
			}

			$this->trackedModelCallbacks[$type][] = $cb;
		}
		elseif ($type == DbTrackTypeEnum::COMMITTED()) {
			return $cb();
		}
	}

	private function prepareSqlParam($val) {
		if ($val instanceof DbParam_Abstract) {
			$val = $val->getVariableValue();
		}

		if ($val instanceof DbParam_Raw) {
			return [$val->__toString(), 'raw'];
		}

		switch ($type = gettype($val)) {
			case 'int':
			case 'integer':
			case 'double':
			case 'NULL':
				return [$val, $type];	// These are fine as is
			case 'boolean':
				return [$val ? 1 : 0, $type];
			case 'array':
				$ret = '';
				$subType = null;
				foreach ($val as $v) {
					if ($ret) {
						$ret .= ',';
					}

					list($v, $vType) = $this->prepareSqlParam($v);
					if ($vType == 'NULL') {
						continue;
					}
					elseif ($vType == 'array') {
						throw new Exception('Array params must not contain other arrays');
					}

					if (is_null($subType)) {
						$subType = $vType;
					}
					elseif ($subType != $vType) {
						throw new Exception('Array params must continue like-typed entries');
					}

					$ret .= $v;
				}

				return ["({$ret})", $type];
			case 'object':
				if (method_exists($val, '__toString')) {
					$val = $val->__toString();
				}
				else {
					throw new Exception('Object cannot be used as a parameter in a query');
				}
				// Passthru intended
			case 'string':
				return ["'" . $this->conn->real_escape_string($val) . "'", 'string'];
			default:
				throw new Exception(gettype($val) . ' cannot be used as a parameter in a query');
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