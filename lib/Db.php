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

    public function query($sql, ...$args) {
		if (count($args) == 1 && is_array($args[0])) {
			$args = $args[0];
		}

		foreach ($args as $key => $val) {
			if (is_string($val)) {
				$args[$key] = "'" . $this->conn->real_escape_string($val) . "'";
			}
		}

		$sql = preg_replace_callback('/([\'"]?):([a-zA-Z0-9_-]+):\\1/', function($matches) use ($args) {
			return isset($args[$matches[2]])
				? $args[$matches[2]]
				: 'NULL';
		}, $sql);

		$sql = trim($sql);

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

    public function getLastError() {
        return $this->conn->error;
	}
	
	public function startTransaction() {
		$this->conn->autocommit(false);
		$this->trackingModels = true;
	}

	public function abortTransaction() {
		$this->conn->rollback();
		$this->conn->autocommit(true);
		$this->trackedCallbacks = [];
		$this->trackingModels = false;
	}

	public function commitTransaction() {
		$this->conn->commit();
		$this->conn->autocommit(true);
		foreach ($this->trackedCallbacks as $existenc) {
			$existenc[0] = $existenc[1];
		}
		$this->trackedCallbacks = [];
		$this->trackingModels = false;
	}

	public function isTrackingModels() {
		return $this->trackingModels;
	}

	public function trackModel(&$exist, $futureValue) {
		if ($this->trackingModels) {
			$this->trackedModelsExistences[] = [&$exist, $futureValue];
		}
	}
}