<?php

class DI {
	private static $defaultInstance = null;
	private $typeDict = [];
	private $stackLevelExtra = 0;

	public static function getDefault() {
		if (is_null(self::$defaultInstance)) {
			self::$defaultInstance = new self();
		}

		return self::$defaultInstance;
	}

	public function addTransient($class, $factory) {
		if (!is_callable($factory) && !class_exists($factory)) {
			throw new Exception('Factory provided is not a function or class name');
		}

		$this->typeDict[$class] = is_callable($factory)
			? $factory
			: function() use ($factory) {
				return $this->constructClass($factory);
			};
	}

	public function addScoped($class, $factory) {
		$cached = null;

		$this->typeDict[$class] = function() use ($factory, &$cached) {
			if (is_null($cached)) {
				if (is_callable($factory)) {
					$cached = $factory($this);
				}
				elseif (is_string($factory) && class_exists($factory)) {
					$cached = $this->constructClass($factory);
				}
				else {
					$cached = $factory;
				}
			}

			return $cached;
		};
	}

	public function get($name) {
		return isset($this->typeDict[$name])
			? $this->typeDict[$name]()
			: null;
	}

	public function constructClass($class) {
		try {
			$this->stackLevelExtra = 1;
			return $this->callMethod($class, '__construct');
		}
		finally {
			$this->stackLevelExtra = 0;
		}
	}

	public function callMethod($classOrInst, $method = '__construct') {
		$refClass = new ReflectionClass($classOrInst);

		if ($method === '__construct') {
			$refMethod = $refClass->getConstructor();
		}
		else {
			$refMethod = $refClass->getMethod($method);

			if (is_null($refMethod)) {
				throw new Exception("The method '{$method}' does not exist");
			}
		}

		if (!is_null($refMethod) && !$refMethod->isPublic()) {
			throw new Exception("The method '{$method}' is not public");
		}

		if ($refMethod) {
			$params = array_map(function($param) use ($classOrInst, $method) {
				$type = $param->getType()->getName();
	
				if (!isset($this->typeDict[$type])) {
					$msg = "DI unabled to resolve type '{$type}' from the ";
					if ($method === '__construct') {
						$msg .= "constructor of '{$classOrInst}'";
					}
					else {
						$msg .= "method '{$method}'";
					}
	
					throw new DIResolutionException($msg, 2 + $this->stackLevelExtra);
				}
	
				return $this->get($type);
			}, $refMethod->getParameters());
		}
		else {
			$params = [];
		}

		if (is_string($classOrInst)) {
			if ($method === '__construct') {
				return new $classOrInst(...$params);
			}
			else {
				return $classOrInst::$method(...$params);
			}
		}
		
		return $classOrInst->$method(...$params);
	}
}