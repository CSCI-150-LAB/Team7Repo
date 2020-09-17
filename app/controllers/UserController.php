<?php

class UserController extends Controller {
    public function LoginAction() {
        // Process result from queries

        return $this->view(['result' => 42]);
    }
}