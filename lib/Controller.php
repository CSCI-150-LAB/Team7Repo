<?php

/**
 * @property mixed $viewHelpers
 */
class Controller {
    protected $layout = 'default';
    protected $viewHelpers;
    protected $request;
    
    public function __construct(Request $request, IViewHelpers $viewHelpers) {
        $this->request = $request;
        $this->viewHelpers = $viewHelpers;
    }

	/**
	 * Retrieves the specified type from the dependency injection service
	 *
	 * @param string $name
	 * @return mixed
	 */
    public function get($name) {
        return DI::getDefault()->get($name);
    }

	/**
	 * Returns an action response wrapping a view render
	 *
	 * @param array $payload
	 * @param string $viewName
	 * @param string|null $layout
	 * @return Response_View
	 */
    public function view($payload = [], $viewName = null, $layout = null) {
        if (is_null($layout)) {
            $layout = $this->layout;
        }

        if (is_null($viewName)) {
            $viewName = $this->request->getActionName();
        }

        return new Response_View(
            $viewName,
            $layout,
            $payload
        );
    }

	/**
	 * Returns an action response wrapping data to be json encoded
	 *
	 * @param mixed $payload
	 * @return Response_Json
	 */
    public function json($payload) {
        return new Response_Json($payload);
    }

	/**
	 * Returns an action result performing an internal redirect to another route
	 *
	 * @param string $requestUri
	 * @param array $get
	 * @param array $post
	 * @return Response_Forwarding
	 */
    public function forward($requestUri, $get = [], $post = []) {
        return new Response_Forwarding($requestUri, $get, $post);
    }

	/**
	 * Returns an action result wrapping html text
	 *
	 * @param string $html
	 * @return Response_Html
	 */
    public function html($html) {
        return new Response_Html($html);
    }

	/**
	 * Returns an action result performing either a 302 or 301 redirect to the specified url
	 *
	 * @param string $url
	 * @param boolean $permanent
	 * @return Response_Redirect
	 */
    public function redirect($url, $permanent = false) {
        return new Response_Redirect($url, $permanent);
    }

	/**
	 * Returns an action result wrapping text to be returns as javascript
	 *
	 * @param string $code
	 * @return Response_Javascript
	 */
    public function javascript($code) {
        return new Response_Javascript($code);
    }

	/**
	 * Returns an action result that delivers a file to be downloaded
	 *
	 * @param string $path
	 * @param string $fileName
	 * @return Response_File
	 */
    public function file($path, $fileName = null) {
        return new Response_File($path, $fileName);
    }
}