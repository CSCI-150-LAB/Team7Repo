<?php

class Response_View extends Response_Html {
    public function __construct($view, $layout, $payload = []) {
        $views = [
            $view => $payload,
        ];

        if ($layout) {
            $layoutFile = APP_ROOT . '/app/layouts/' . $layout . '.php';
            $views[$layoutFile] = [];
		}
		
		$html = DI::getDefault()->get('ViewRenderer')->render($views);
        parent::__construct($html);
    }
}