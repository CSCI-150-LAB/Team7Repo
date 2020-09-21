<?php

class Response_Javascript implements IResponse {
    private $code;

    public function __construct($code) {
        $this->code = $code;
    }

    public function output() {
        header('Content-Type: text/javascript');
        echo $this->code;
    }
}