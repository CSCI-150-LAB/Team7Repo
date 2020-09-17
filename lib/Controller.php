<?php

class Controller {
    protected $layout = 'default';
    private $request;
    
    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function get($name) {
        return DI::getDefault()->get($name);
    }

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

    public function json($payload) {
        return new Response_Json($payload);
    }

    public function forward($requestUri, $get = [], $post = []) {
        return new Response_Forwarding($requestUri, $get, $post);
    }

    public function html($html) {
        return new Response_Html($html);
    }

    public function redirect($url, $permanent = false) {
        return new Response_Redirect($url, $permanent);
    }

    public function javascript($code) {
        return new Response_Javascript($code);
    }

    public function file($path, $fileName = null) {
        return new Response_File($path, $fileName);
    }
}