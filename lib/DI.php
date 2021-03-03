<?php

class DI {
	private static $defaultInstance = null;
	private $typeDict = [];
	private $scopedInstances = [];
	private $stackLevelExtra = 0;

	/**
	 * Returns a static instance
	 *
	 * @return DI
	 */
	public static function getDefault() {
		if (is_null(self::$defaultInstance)) {
			self::$defaultInstance = new self();
		}

		return self::$defaultInstance;
	}

	/**
	 * Registers a factory that must be called every time to generate the resource
	 *
	 * @param string $class
	 * @param mixed $factory
	 * @return void
	 */
	public function addTransient($class, $factory) {
		if (!is_callable($factory) && !class_exists($factory)) {
			throw new Exception('Factory provided is not a function or class name');
		}

		if (isset($this->scopedInstances[$class])) {
			unset($this->scopedInstances[$class]);
		}

		$this->typeDict[$class] = is_callable($factory)
			? $factory
			: function() use ($factory) {
				return $this->constructClass($factory);
			};
	}

	/**
	 * Registers a factory that will be called at most once to generate the resource
	 *
	 * @param string $class
	 * @param mixed $factory
	 * @return void
	 */
	public function addScoped($class, $factory) {
		if (isset($this->scopedInstances[$class])) {
			unset($this->scopedInstances[$class]);
		}

		$this->typeDict[$class] = function() use ($class, $factory) {
			if (is_null($this->scopedInstances[$class])) {
				if (is_callable($factory)) {
					$this->scopedInstances[$class] = $factory($this);
				}
				elseif (is_string($factory) && class_exists($factory)) {
					$this->scopedInstances[$class] = $this->constructClass($factory);
				}
				else {
					$this->scopedInstances[$class] = $factory;
				}
			}

			return $this->scopedInstances[$class];
		};
	}

	/**
	 * Given a resource name, fetch or generate the service
	 *
	 * @param string $name
	 * @return mixed
	 */
	public function get($name) {
		return isset($this->typeDict[$name])
			? $this->typeDict[$name]()
			: null;
	}

	/**
	 * Constructs a specified class, filling in the constructor parameters using the injection service
	 *
	 * @param string $class
	 * @return mixed
	 */
	public function constructClass($class) {
		try {
			$this->stackLevelExtra = 1;
			return $this->callMethod($class, '__construct');
		}
		finally {
			$this->stackLevelExtra = 0;
		}
	}

	/**
	 * Calls a class method, filling in the method parameters using the injection service
	 *
	 * @param mixed $classOrInst
	 * @param string $method
	 * @return mixed
	 */
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

	public function clearAll() {
		foreach ($this->scopedInstances as $ndx => $val) {
			unset($this->scopedInstances[$ndx]);
		}

		foreach ($this->typeDict as $ndx => $val) {
			unset($this->scopedInstances[$ndx]);
		}
	}
}