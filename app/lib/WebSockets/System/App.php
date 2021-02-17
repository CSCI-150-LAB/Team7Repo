<?php

class WebSockets_System_App implements WebSockets_IApp {
	/** @var WebSockets_Server */
	private $server;
	private $connectedUsers = 0;

	public function __construct(WebSockets_Server $server) {
		$this->server = $server;

		$filePath = APP_ROOT . '/shutdown_websocket_server.txt';
		$server->addPeriodicTimer(function() use ($filePath, $server) {
			if (file_exists($filePath)) {
				unlink($filePath);
				$server->stop();
			}
		}, 30);
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
		if (!$user->isAuthenticated() && $data instanceof WebSockets_Message_Auth) {
			$user->authenticate($data);
		}
	}
}