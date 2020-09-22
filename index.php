<?php

/**
 * Minimal MVC Framework
 *   By Daniel Flynn 9/16/2020
 */

define('APP_ROOT', __DIR__);
define('IS_LOCAL', in_array($_SERVER['SERVER_NAME'], ['localhost', '127.0.0.1']));

require __DIR__ . '/lib/Autoloader.php';

Autoloader::init([
	__DIR__ . DIRECTORY_SEPARATOR . 'lib',
	__DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'controllers',
	__DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'models'
]);

/* Application Start */

(new Application())
	->bootstrap(function($app) {
		session_start();
		EnvLoader::load();

		// Provide overrides
		// ie. $app->setRequestClass('Custom_Request');

		// Provide helper classes
		$di = DI::getDefault();
		
		$di->addScoped('Db', function() {
			return new Db($_ENV['dbhost'], $_ENV['dbuser'], $_ENV['dbpass'], $_ENV['dbname']);
		});
	})
	->start();