<?php

use Ratchet\ConnectionInterface;

class WebSockets_User {
	/** @var User */
	private $user;
	private $conn;

	public function __construct(ConnectionInterface $conn) {
		$this->conn = $conn;
	}

	public function getUser() {
		return $this->user;
	}

	public function getUserId() {
		return $this->user
			? $this->user->id
			: 0;
	}

	public function isAuthenticated() {
		return !is_null($this->user);
	}

	public function authenticate(WebSockets_Message_Auth $data) {
		if ($data->userId) {
			$this->user = User::findOne('id = :0: AND password = :1:', $data->userId, $data->userToken);
		}
		else {
			$this->user = null;
		}
		
		$this->send(new WebSockets_Message_UserStatus(['userId' => $this->user ? $this->user->id : null]));
	}

	public function closeConnection() {
		$this->conn->close();
	}

	public function send($data) {
		$this->conn->send(json_encode($data));
	}
}