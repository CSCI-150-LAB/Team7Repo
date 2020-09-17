<?php

class ViewRenderer implements IViewRenderer {
    private $__output = '';

    public function render(array $__views) {
        array_walk($__views, function($__payload, $__file) {
            extract($__payload);

            ob_start();
            require($__file);
            $this->__output = ob_get_clean();
        });

        return $this->__output;
    }

    public function getContents() {
        return $this->__output;
    }

    public function __call($fn, $args) {
        $viewHelpers = DI::getDefault()->get('ViewHelpers');

        if (method_exists($viewHelpers, $fn)) {
            return $viewHelpers->$fn(...$args);
        }

        return null;
    }
}