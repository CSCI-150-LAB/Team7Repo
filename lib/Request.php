<?php

class Request {
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
}