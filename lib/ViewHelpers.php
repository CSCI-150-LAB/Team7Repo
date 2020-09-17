<?php

class ViewHelpers {
    private $app;
    private $elementClasses = [];
    private $scripts;
    private $styles;

    public function __construct(Application $app) {
        $this->app = $app;

        $this->scripts = [
            'collection' => new DepCollection(),
            'header' => [],
            'footer' => []
        ];

        $this->styles = [
            'collection' => new DepCollection(),
            'needed' => []
        ];
    }

    public function baseUrl($url = '') {
        return $this->app->getBaseUrl() . ltrim($url, '/');
    }

    public function publicUrl($url = '') {
        return $this->app->getBaseUrl() . 'public/' . ltrim($url, '/');
    }

    public function escapeHtml($html) {
        return htmlentities($html, ENT_COMPAT);
    }

    public function bodyClass($class = '') {
        return $this->elementClass('body', $class);
    }

    public function elementClass($element, $class = '') {
        if (!isset($this->elementClasses[$element])) {
            $this->elementClasses[$element] = '';
        }

        if ($class !== '') {
            $this->elementClasses[$element] .= ' ' . $class;
        }
        return $this->elementClasses[$element];
    }

    public function scriptRegister($name, $urlOrSrc, $deps = []) {
        $this->scripts['collection']->addResource($name, $urlOrSrc, $deps);
    }

    public function scriptEnqueue($name, $urlOrSrc = true, $deps = [], $header = true) {
        if (is_bool($urlOrSrc)) {
            $this->scripts[$urlOrSrc ? 'header' : 'footer'][] = $name;
        }
        else {
            $this->scripts['collection']->addResource($name, $urlOrSrc, $deps);
            $this->scripts[$header ? 'header' : 'footer'][] = $name;
        }
    }

    public function styleRegister($name, $url, $deps = []) {
        $this->styles['collection']->addResource($name, $url, $deps);
    }

    public function styleEnqueue($name, $url = false, $deps = []) {
        if ($url) {
            $this->styles['collection']->addResource($name, $url, $deps);
        }

        $this->styles['needed'][] = $name;
    }

    public function outputScripts($location = 'header') {
        $resources = $this->scripts['collection']->getOrderedList($this->scripts[$location]);
        foreach ($resources as $res) {
            if (strpos($res, 'http') === 0 || strpos($res, '//') === 0) {
                echo '<script' . ' type="text/javascript" src="' . $res . '"></script>' . PHP_EOL;
            }
            else {
                echo '<script' . ' type="text/javascript">' . PHP_EOL . $res . PHP_EOL . '</script>' . PHP_EOL;
            }
        }
    }

    public function outputStyles() {
        $resources = $this->styles['collection']->getOrderedList($this->styles['needed']);
        foreach ($resources as $res) {
            if (strpos($res, 'http') === 0 || strpos($res, '//') === 0) {
                echo '<link rel="stylesheet" href="' . $res . '">' . PHP_EOL;
            }
            else {
                echo '<style>' . PHP_EOL . $res . PHP_EOL . '</style>' . PHP_EOL;
            }
        }
    }

    public function partial($view, $payload = []) {
        $viewFile = APP_ROOT . '/app/views/' . DI::getDefault()->get('Request')->getControllerName() . '/' . $view . '.php';
        
        $views = [
            $viewFile => $payload
        ];

        return DI::getDefault()->get('ViewRenderer')->render($views);
    }
    }
}