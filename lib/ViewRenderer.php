<?php

/**
 * Class used to encapsulate of view files
 */
class ViewRenderer implements IViewRenderer {
    private $__output = '';

	/**
	 * Renders file successively. Accepts and array of file path keys and data payload values
	 *
	 * @param array $views
	 * @return string
	 */
    public function render(array $views) {
        array_walk($views, function($__payload, $__file) {
            extract($__payload);

            ob_start();
            require($__file);
            $this->__output = ob_get_clean();
        });

        return $this->__output;
    }

	/**
	 * Retrieves the last rendered file's output
	 *
	 * @return string
	 */
    public function getContents() {
        return $this->__output;
    }

	/**
	 * Invokes a ViewHelper function
	 *
	 * @param string $fn
	 * @param array $args
	 * @return mixed
	 */
    public function __call($fn, $args) {
        $viewHelpers = DI::getDefault()->get('IViewHelpers');

        if (method_exists($viewHelpers, $fn)) {
            return $viewHelpers->$fn(...$args);
        }

        return null;
    }
}