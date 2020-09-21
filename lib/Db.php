<?php

class Db {
    private $conn;

    public function __construct($host, $user, $pass, $dbname) {
        $this->conn = new mysqli($host, $user, $pass, $dbname);

        if ($this->conn->connect_errno) {
            throw new Exception('MySQL connect failed: ' . $this->conn->connect_errno);
        }
    }

    public function __destruct() {
        $this->conn->close();
    }

    public function query($sql, ...$args) {
        $sql = str_replace("'%s'", '%s', $sql);
        $sql = str_replace('"%s"', '%s', $sql);
        $sql = preg_replace('/(?<!%)%s/', "'%s'", $sql);

        $args = array_map(function($v) {
            if (!is_string($v)) {
                return $v;
            }

            return $this->conn->real_escape_string($v);
        }, $args);

        die(vsprintf($sql, $args));

        $result = $this->conn->query(vsprintf($sql, $args));

        if ($result === true) {
            return $this->conn->insert_id;
        }
        elseif ($result instanceof mysqli_result) {
            return $result->fetch_assoc();
        }
        else {
            return false;
        }
    }

    public function getLastError() {
        return $this->conn->error;
    }
}