<?php

class DbParam_Raw extends DbParam_Abstract {
	public function __construct($rawValue) {
		$this->value = $rawValue;
	}

	public function getVariableValue() {
		return $this;
	}

	public function __toString() {
		return $this->value;
	}

	public static function from($rawValue) {
		return new self($rawValue);
	}
}