<?php

class Response_View implements IResponse {
    private $__view;
    private $__layout;
    private $__payload;
    private $__html;

    public function __construct($viewFile, $layout, $payload) {
        $this->__view = $viewFile;
        $this->__layout = $layout;
        $this->__payload = $payload;

        $this->render();
    }

    private function render() {
        extract($this->__payload);

        ob_start();
        require(APP_ROOT . '/app/views/' . DI::getDefault()->get('Request')->getControllerName() . '/' . $this->__view . '.php');
        $this->__html = ob_get_clean();

        if ($this->__layout) {
            ob_start();
            require(APP_ROOT . '/app/layouts/' . $this->__layout . '.php');
            $this->__html = ob_get_clean();
        }
    }

    public function getContents() {
        return $this->__html;
    }

    public function output() {
        echo $this->__html;
    }

    public function __call($fn, $args) {
        $viewHelpers = DI::getDefault()->get('ViewHelpers');

        if (method_exists($viewHelpers, $fn)) {
            return $viewHelpers->$fn(...$args);
        }

        return null;
    }
}