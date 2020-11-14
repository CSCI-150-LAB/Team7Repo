<?php

abstract class Enum extends AnnotatedClass {
	private static $enumCache = [];
	private $value;

	public function __construct(string $value) {
		$cache = & static::getCache();

		if (!isset($cache[$value])) {
			throw new Exception(static::class . " does not contain enum value '{$value}'");
		}

		$this->value = $value;
	}

	public function __toString() {
		return $this->value;
	}

	public function equals($other) {
		if ($other instanceof Enum) {
			return $this->value === $other->__toString();
		}
		elseif (is_string($other)) {
			return $this->value === $other;
		}

		return false;
	}

	/**
	 * @access private
	 * @ignore
	 */
	public static function __callStatic($name, $arguments = []) {
		$cache = & static::getCache();

		if (!isset($cache[$name])) {
			throw new Exception(static::class . " does not contain enum value '{$name}'");
		}

		if ($cache[$name] === true) {
			$cache[$name] = new static($name);
		}

		return $cache[$name];
	}

	private static function &getCache() {
		if (!isset(self::$enumCache[static::class])) {
			$classMeta = static::getAnnotations();

			self::$enumCache[static::class] = [];
			if (isset($classMeta['class']['meta']['method'])) {
				foreach ($classMeta['class']['meta']['method'] as $method) {
					if ($method['static'] && !count($method['args'])) {
						self::$enumCache[static::class][$method['name']] = true;
					}
				}
			}
		}

		return self::$enumCache[static::class];
	}
}
