<?php

/**
 * @Table('options')
 */
class Options extends Model {
	private static $cache = null;

	/**
	 * @Key
	 */
	public $name;
	public $value;

	protected function getProp($prop) {
		if ($prop == 'value') {
			return serialize($this->$prop);
		}

		return parent::getProp($prop);
	}

	protected function setProp($prop, $value) {
		if ($prop == 'value') {
			$this->$prop = unserialize($value);
		}
		else {
			parent::setProp($prop, $value);
		}
	}

	private static function loadOptions() {
		if (is_null(self::$cache)) {
			self::$cache = [];

			foreach (self::find() as $row) {
				self::$cache[$row->name] = $row;
			}
		}
	}

	public static function getOption($name) {
		self::loadOptions();

		if (isset(self::$cache[$name])) {
			return self::$cache[$name]->value;
		}

		return null;
	}

	public static function setOption($name, $value) {
		self::loadOptions();

		if (isset(self::$cache[$name])) {
			$record = self::$cache[$name];
		}
		else {
			$record = new self();
			$record->name = $name;
		}

		$record->value = $value;
		$record->save();
	}
}