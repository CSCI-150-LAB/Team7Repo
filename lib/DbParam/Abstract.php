<?php

abstract class DbParam_Abstract {
	protected $value;

	public function getVariableValue() {
		if ($this->value instanceof DbParam_Abstract) {
			return $this->value->getVariableValue();
		}

		return $this->value;
	}
}