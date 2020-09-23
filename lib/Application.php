<?php

/**
 * The heart of the framework
 */
class Application {
	/**
	 * The relative path from the document root to this site root
	 *
	 * @var string $appDir
	 */
	private $appDir;

	/**
	 * The absolute path to this site
	 *
	 * @var string $baseUrl
	 */
	private $baseUrl;

	/**
	 * The server's original, cleaned $_SERVER['REQUEST_URI']
	 *
	 * @var string $requestUri
	 */
	private $requestUri;

	/**
	 * The application's dependency injector
	 *
	 * @var DI $di
	 */
	private $di;

	/**
	 * The class to be used for handling route requests
	 *
	 * @var string $requestClass
	 */
	private $requestClass = 'Request';

	/**
	 * The class to be attached to controllers and views for granting access to helpers
	 *
	 * @var string $viewHelpersClass
	 */
	private $viewHelpersClass = 'ViewHelpers';

	/**
	 * The class to be used for rendering of all views
	 *
	 * @var string $viewRendererClass
	 */
	private $viewRendererClass = 'ViewRenderer';

	public function __construct() {
		$this->parseServerVars();

		$this->di = DI::getDefault();
		$this->di->addScoped('DI', $this->di);
		$this->di->addScoped(Application::class, $this);
	}

	/**
	 * Fetches the root url for the current detected site path
	 *
	 * @return string
	 */
	public function getBaseUrl() {
		return $this->baseUrl;
	}

	/**
	 * Processes the data in $_SERVER
	 * Assigns $appDir, $baseUrl, $requestUri
	 *
	 * @return void
	 */
	private function parseServerVars() {
		$this->appDir = substr(APP_ROOT, strlen($_SERVER['DOCUMENT_ROOT'])) . '/';
		$this->appDir = str_replace('\\', '/', $this->appDir);

		$this->baseUrl = 'http' . ($_SERVER['SERVER_PORT'] === '443' ? 's' : '') . '://';
		$this->baseUrl .= $_SERVER['SERVER_NAME'];
		if (!in_array($_SERVER['SERVER_PORT'], array('80', '443')))
			$this->baseUrl .= ':' . $_SERVER['SERVER_PORT'];
		$this->baseUrl .= $this->appDir;

		list($this->requestUri) = explode('?', $_SERVER['REQUEST_URI'], 2);
		$this->requestUri = substr($this->requestUri, strlen($this->appDir));
		$this->requestUri = rtrim($this->requestUri, '/');
		$this->requestUri = urldecode($this->requestUri);
	}

	/**
	 * Registers ViewRenderer and IViewHelper
	 *
	 * @return void
	 */
	private function configureServices() {
		$this->di->addTransient('ViewRenderer', $this->viewRendererClass);
		$this->di->addScoped('IViewHelpers', $this->viewHelpersClass);
	}

	public function bootstrap(callable $callable) : Application {
		$callable($this);

		return $this;
	}

	public function setRequestClass($class) {
		if (!is_subclass_of($class, 'IRequest')) {
			throw new Exception("{$class} does not implement IRequest");
		}

		$this->requestClass = $class;

		return $this;
	}

	public function setViewHelpersClass($class) {
		if (!is_subclass_of($class, 'IViewHelpers')) {
			throw new Exception("{$class} does not implement IViewHelpers");
		}

		$this->viewHelpersClass = $class;

		return $this;
	}

	public function setViewRendererClass($class) {
		if (!is_subclass_of($class, 'IViewRenderer')) {
			throw new Exception("{$class} does not implement IViewRenderer");
		}

		$this->viewRendererClass = $class;

		return $this;
	}

	/**
	 * Returns the application's dependency injector
	 *
	 * @return DI
	 */
	public function getDI() : DI {
		return $this->di;
	}

	private function configureErrorReporting() {
		$level = E_ALL ^ E_NOTICE;

		if (!IS_LOCAL) {
			$level = $level ^ E_WARNING ^ E_STRICT;
		}

		error_reporting($level);
	}

	public function start() {
		$this->configureServices();
		$this->configureErrorReporting();

		$requestClass = $this->requestClass;
		$request = new $requestClass($this->requestUri, $_GET, $_POST);

		do {
			$this->di->addScoped('Request', $request);
			$response = $this->dispatch($request);
		}
		while (
			$response instanceof Response_Forwarding &&
			$request = new $requestClass(...$response->output())
		);

		$response->output();
	}

	private function dispatch(Request $request) : IResponse {
		$controllerClass = $request->getControllerName() . 'Controller';

		if (!class_exists($controllerClass)) {
			return $this->handle404($request);
		}

		$actionMethod = $request->getActionName() . 'Action';
		if (!method_exists($controllerClass, $actionMethod)) {
			return $this->handle404($request);
		}

		// beforeActionHook
		$controllerInst = $this->di->constructClass($controllerClass);
		if ($controllerInst instanceof IControllerHooks) {
			$response = $controllerInst->beforeActionHook();
			if ($response instanceof IResponse) {
				return $response;
			}
		}

		// Call Controller Action
		$response = $controllerInst->$actionMethod(...$request->getRouteParams());

		// AfterActionHook
		if ($controllerInst instanceof IControllerHooks) {
			$newResponse = $controllerInst->afterActionHook($response);
			if ($newResponse instanceof IResponse) {
				return $newResponse;
			}
		}

		return $response;
	}

	private function handle404(Request $request) {
		if ($request->getActionName() !== 'NotFound') {
			return new Response_Forwarding($request->getControllerName() . '/NotFound');
		}

		if ($request->getControllerName() !== 'Index') {
			return new Response_Forwarding('Index/NotFound');
		}

		http_response_code(404);
		die('Request not found');
	}
}