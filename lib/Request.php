<?php

class Request implements IRequest {
	private $controllerName;
	private $actionName;
	private $routeParams;
	private $get;
	private $post;

	public function __construct($requestUri, $get = [], $post = []) {
		$requestUri = ltrim($requestUri, '/');

		$routeParts = array_replace(
			['Index', 'Index'],
			$requestUri
				? explode('/', $requestUri)
				: []
		);
		foreach (range(0, 1) as $ndx) {
			$routeParts[$ndx] = ucfirst(preg_replace_callback('/[^a-zA-Z0-9]+(\\w)/', function($matches) {
				return strtoupper($matches[1]);
			}, $routeParts[$ndx]));
		}

		list($this->controllerName, $this->actionName) = $routeParts;

		$this->routeParams = array_map(function($p) {
			if ($p === 'TRUE' || $p === 'FALSE' || $p === 'NULL') {
				$p = strtolower($p);
			}

			if ($p === 'null') {
				return null;
			}

			$jsonValue = json_decode($p);

			return is_null($jsonValue) || is_array($jsonValue)
				? $p
				: $jsonValue;
		}, array_slice($routeParts, 2));

		$this->get = $get;
		$this->post = $post;
	}

	public function getControllerName() {
		return $this->controllerName;
	}

	public function getActionName() {
		return $this->actionName;
	}

	public function getGetVar($name) {
		return $this->get[$name] ?? null;
	}

	public function getPostVar($name) {
		return $this->post[$name] ?? null;
	}

	public function getRequestVar($name) {
		return $this->getPostVar($name) ?? $this->getGetVar($name) ?? null;
	}

	public function getRouteParams() {
		return $this->routeParams;
	}

	public function isActive($path, $exact = false) {
		$path = trim($path, '/');
		if ($path === '') {
			$path = 'Index/Index';
		}

		if (strpos($path . '/', "{$this->controllerName}/{$this->actionName}/") !== 0) {
			return false;
		}

		if ($exact) {
			$routeParams = array_slice(explode('/', $path), 2);

			if ($routeParams != $this->routeParams) {
				return false;
			}
		}

		return true;
	}

	public function getRequestType() {
		return strtoupper($_SERVER['REQUEST_METHOD']);
	}

	public function isPost() {
		return $this->getRequestType() === 'POST';
	}

	public function isGet() {
		return $this->getRequestType() === 'GET';
	}
}