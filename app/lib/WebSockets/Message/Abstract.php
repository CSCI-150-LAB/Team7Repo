<?php

abstract class WebSockets_Message_Abstract implements JsonSerializable {
	public function __construct($data = null) {
		if (!is_null($data)) {
			$this->copyData($data);
		}
	}

	public function copyData($data) {
		if (is_array($data)) {
			foreach (get_object_vars($this) as $key => $val) {
				if (isset($data[$key])) {
					$this->$key = $data[$key];
				}
			}
		}
		elseif (is_object($data)) {
			foreach (get_object_vars($this) as $key => $val) {
				if (property_exists($data, $key)) {
					$this->$key = $data->$key;
				}
			}
		}
	}

	protected function getJsonData() {
		return get_object_vars($this);
	}

	public function jsonSerialize() {
		$class = explode('_', static::class);
		
		return [
			'type' => end($class),
			'data' => $this->getJsonData()
		];
	}

	public function getType() {
		return end(explode('_', static::class));
	}
}