<?php

class WebSockets_System_App implements WebSockets_IApp {
	/** @var WebSockets_Server */
	private $server;
	private $connectedUsers = 0;

	public function __construct(WebSockets_Server $server) {
		$this->server = $server;
	}

	public function onUserConnect(WebSockets_User $user) {
		$this->connectedUsers++;

		$this->server->addTimer(function() use ($user) {
			if (!$user->isAuthenticated()) {
				$user->closeConnection();
			}
		}, 5);
	}

	public function onUserDisconnect(WebSockets_User $user) {
		$this->connectedUsers--;
	}

	public function onMessage(WebSockets_User $user, $data) {
		if ($user->isAuthenticated()) {
			//TODO: Only admins should be able to do this
			if ($data instanceof WebSockets_Message_ShutdownServer) {
				$this->server->stop();
			}
		}
		else {
			if ($data instanceof WebSockets_Message_Auth) {
				$user->authenticate($data);
			}
		}
	}
}