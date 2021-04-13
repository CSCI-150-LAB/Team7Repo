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
	__DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'models',
	__DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'lib'
]);

/* Application Start */

(new Application())
	->hook(function($app) {
		require_once APP_ROOT . '/app/lib/vendor/autoload.php';
		if (ob_get_level()) {
			ob_end_clean();
		}
		ob_start();

		session_start();
		EnvLoader::load();

		// Provide overrides
		// ie. $app->setRequestClass('Custom_Request');

		// Provide helper classes
		$di = DI::getDefault();
		
		$di->addScoped('Db', function() {
			return new Db($_ENV['dbhost'], $_ENV['dbuser'], $_ENV['dbpass'], $_ENV['dbname']);
		});

		$di->addScoped('googleApiHelper', function() use ($app) {
			return new GoogleApi_Helper($_ENV['googleClientId'], $_ENV['googleClientSecret'], $app->getBaseUrl() . '/Admin/GenerateGoogleAccessCode');
		});
	})
	->start()
	->hook(function() {
		WebSockets_Helpers::closeBrowserConnection();

		if (!WebSockets_Helpers::isServerRunning()) {
			$di = DI::getDefault();
			$di->clearAll();

			// TODO: Duplicate of the hook above
			$di->addScoped('Db', function() {
				return new Db($_ENV['dbhost'], $_ENV['dbuser'], $_ENV['dbpass'], $_ENV['dbname']);
			});

			$serverApp = new WebSockets_ServerApp();
			$di->addScoped('WebSockets_Server', $serverApp->getServer());

			$serverApp->addApplication(WebSockets_System_App::class);
			$serverApp->addApplication(WebSockets_Chat_App::class);

			$serverApp->start();
		}
	});