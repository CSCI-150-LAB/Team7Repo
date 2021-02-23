<?php

class WebSockets_System_App implements WebSockets_IApp {
	/** @var WebSockets_Server */
	private $server;
	/** @var WebSockets_User[] */
	private $allUsers = [];

	public function __construct(WebSockets_Server $server) {
		$this->server = $server;
	}

	public function onUserConnect(WebSockets_User $user) {
		$this->allUsers[] = $user;

		// Catch up user with current user list
		//TODO: Replace with a sub/unsub model
		foreach ($this->allUsers as $otherUser) {
			if ($otherUser->isAuthenticated()) {
				$status = new WebSockets_Message_UserStatus(['userId' => $otherUser->getUserId(), 'status' => 'online']);
				$user->send($status);
			}
		}
	}

	public function onUserDisconnect(WebSockets_User $user) {
		$ndx = array_search($user, $this->allUsers);
		if ($ndx >= 0) {
			unset($this->allUsers[$ndx]);
		}

		if ($user->isAuthenticated()) {
			$status = new WebSockets_Message_UserStatus(['userId' => $user->getUserId(), 'status' => 'offline']);

			foreach ($this->allUsers as $otherUser) {
				$otherUser->send($status);
			}
		}
	}

	public function onUserAuthChanged(WebSockets_User $user) {
		$status = new WebSockets_Message_UserStatus(['userId' => $user->getUserId(), 'status' => $user->isAuthenticated() ? 'online' : 'offline']);

		foreach ($this->allUsers as $otherUser) {
			$otherUser->send($status);
		}
	}

	public function onMessage(WebSockets_User $user, WebSockets_Message_Abstract $data) {
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