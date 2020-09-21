<?php

class Response_View implements IResponse {
    private $html;

    public function __construct($view, $layout, $payload = []) {
        $viewFile = APP_ROOT . '/app/views/' . DI::getDefault()->get('Request')->getControllerName() . '/' . $view . '.php';
        
        $views = [
            $viewFile => $payload,
        ];

        if ($layout) {
            $layoutFile = APP_ROOT . '/app/layouts/' . $layout . '.php';
            $views[$layoutFile] = [];
        }

        $this->html = DI::getDefault()->get('ViewRenderer')->render($views);
    }

    public function output() {
        echo $this->html;
    }
}