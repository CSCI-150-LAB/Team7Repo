<?php

abstract class WebSockets_Message_Abstract implements JsonSerializable {
	public function __construct(array $data) {
		foreach (get_object_vars($this) as $key => $val) {
			if (isset($data[$key])) {
				$this->$key = $data[$key];
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
}