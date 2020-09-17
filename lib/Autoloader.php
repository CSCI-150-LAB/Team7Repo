<?php

class Autoloader
{
	public static function init($paths = []) {
		set_include_path(implode(PATH_SEPARATOR, array_merge($paths, [get_include_path()])));
		spl_autoload_register(array('Autoloader', 'autoload'));
	}

	public static function autoload($class) {
		$paths = explode(PATH_SEPARATOR, get_include_path());
		$classPath = '/' . implode('/', explode('_', $class)) . '.php';
		foreach ($paths as $path) {
			$tmp = rtrim($path, '/\\') . $classPath;

			if (is_file($tmp)) {
				require $tmp;
				return true;
			}
		}

		return false;
	}
}