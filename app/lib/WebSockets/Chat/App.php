<?php

class WebSockets_Chat_App implements WebSockets_IApp {
	private $rooms = [];
	private $userRoomMap = [];

	public function __construct() {
		$this->userRoomMap = new SplObjectStorage;
	}

	public function onUserConnect(WebSockets_User $user) {
		// Not Needed
	}

	public function onUserDisconnect(WebSockets_User $user) {
		// Disconnect the user from their room
		if (isset($this->userRoomMap[$user])) {
			foreach ($this->userRoomMap[$user] as $room) {
				/** @var WebSockets_Chat_Room $room */
				$room->disconnectUser($user);
			}
		}
	}

	public function onMessage(WebSockets_User $user, $data) {
		if (!$user->isAuthenticated()) {
			return;
		}

		if ($data instanceof WebSockets_Message_Chat) {
			
		}
	}
}