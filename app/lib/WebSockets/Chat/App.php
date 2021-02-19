<?php

class WebSockets_Chat_App implements WebSockets_IApp {
	private $userIdConnectionMap = [];
	private $connectionConversationMap;

	public function __construct() {
		$this->connectionConversationMap = new SplObjectStorage;
	}

	public function onUserConnect(WebSockets_User $user) {
		// Not Needed
	}

	public function onUserDisconnect(WebSockets_User $user) {
		if ($user->isAuthenticated()) {
			$ndx = array_search($user, $this->userIdConnectionMap[$user->getUserId()]);
			if ($ndx >= 0) {
				unset($this->userIdConnectionMap[$user->getUserId()][$ndx]);
			}
		}

		if (isset($this->connectionConversationMap[$user])) {
			unset($this->connectionConversationMap[$user]);
		}
	}

	public function onUserAuthChanged(WebSockets_User $user) {
		if ($user->isAuthenticated()) {
			if (!isset($this->userIdConnectionMap[$user->getUserId()])) {
				$this->userIdConnectionMap[$user->getUserId()] = [];
			}
			$this->userIdConnectionMap[$user->getUserId()][] = $user;
		}
	}

	public function onMessage(WebSockets_User $user, WebSockets_Message_Abstract $data) {
		if (!$user->isAuthenticated()) {
			return;
		}

		if ($data instanceof WebSockets_Message_JoinChatRoom) {
			$conversation = ChatConversation::getConversation($user->getUserId(), $data->withUserId, true);

			$this->connectionConversationMap[$user] = $conversation;
			
			$data->conversationId = $conversation->id;
			$user->send($data);

			// Send messages to user
			$chatMessage = new WebSockets_Message_Chat();
			foreach ($conversation->getMessages() as $dbMessage) {
				$chatMessage->copyData($dbMessage);
				$user->send($chatMessage);
			}
		}
		else if ($data instanceof WebSockets_Message_Chat) {
			if (isset($this->connectionConversationMap[$user])) {
				/** @var ChatConversation */
				$conversation = $this->connectionConversationMap[$user];

				$data->read = false;
				$data->authorId = $user->getUserId();
				$data->createdAt = date('Y-m-d H:i:s');
				$data->conversationId = $conversation->id;

				// Store in db
				$dbChatMessage = ChatMessage::fromArray((array)$data);
				$dbChatMessage->save();
				
				$otherUserId = $conversation->getOtherUser($user->getUserId());

				if ($otherUserId != $user->getUserId()) {
					foreach ($this->userIdConnectionMap[$user->getUserId()] as $otherConnection) {
						/** @var WebSockets_User $otherConnection */
						if (isset($this->connectionConversationMap[$otherConnection])) {
							/** @var ChatConversation */
							$someConversation = $this->connectionConversationMap[$otherConnection];
							if ($someConversation->id == $conversation->id) {
								$otherConnection->send($data);
							}
						}
					}
				}
				
				if (isset($this->userIdConnectionMap[$otherUserId])) {
					foreach ($this->userIdConnectionMap[$otherUserId] as $otherUser) {
						/** @var WebSockets_User $otherUser */
						$otherUser->send($data);
					}
				}
			}
		}
	}
}