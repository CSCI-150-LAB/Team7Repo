<?php

class WebSockets_Chat_App implements WebSockets_IApp {
	private $rooms = [];
	private $userRoomMap;

	private $usersInHardCodedRoom = [];

	public function __construct() {
		$this->userRoomMap = new SplObjectStorage;
	}

	public function onUserConnect(WebSockets_User $user) {
		// Not Needed
	}

	public function onUserDisconnect(WebSockets_User $user) {
		// Disconnect the user from their room
		// if (isset($this->userRoomMap[$user])) {
		// 	foreach ($this->userRoomMap[$user] as $room) {
		// 		/** @var WebSockets_Chat_Room $room */
		// 		$room->disconnectUser($user);
		// 	}
		// }

		$resp = new WebSockets_Message_Chat(['message' => "User {$user->getUser()->getFullName()} Left the chat"]);
		foreach ($this->usersInHardCodedRoom as $ndx => $otherUser) {
			if ($otherUser === $user) {
				unset($this->usersInHardCodedRoom[$ndx]);
			}
			else {
				$otherUser->send($resp);
			}
		}
	}

	public function onMessage(WebSockets_User $user, $data) {
		if (!$user->isAuthenticated()) {
			return;
		}

		if ($data instanceof WebSockets_Message_JoinChatRoom) {
			$resp = new WebSockets_Message_Chat(['message' => "User {$user->getUser()->getFullName()} Joined the chat"]);
			foreach ($this->usersInHardCodedRoom as $otherUser) {
				/** @var WebSockets_User $otherUser */
				$otherUser->send($resp);
			}

			$this->usersInHardCodedRoom[] = $user;
		}
		else if ($data instanceof WebSockets_Message_Chat) {
			foreach ($this->usersInHardCodedRoom as $otherUser) {
				/** @var WebSockets_User $otherUser */
				if ($otherUser !== $user) {
					$otherUser->send($data);
				}
			}
		}
	}
}