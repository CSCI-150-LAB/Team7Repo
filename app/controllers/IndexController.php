<?php

class IndexController extends Controller {
    public function IndexAction() {
        return $this->view();
    }

    public function NotFoundAction() {
        http_response_code(404);
        return $this->view();
    }
}