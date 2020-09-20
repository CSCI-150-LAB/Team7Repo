<?php

class Db {
    private $conn;

    public function __construct($host, $user, $pass, $dbname) {
        $this->conn = new mysqli($host, $user, $pass, $dbname);
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function getLastInsertedId() {
        return $this->conn->insert_id;
    }
}