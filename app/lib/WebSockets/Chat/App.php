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
			$conversationUserIds = array_merge($data->withUserIds, [$user->getUserId()]);
			$conversation = ChatConversation::getConversation($conversationUserIds, true);

			$this->connectionConversationMap[$user] = $conversation;
			
			$data->withUserIds = $conversation->users;
			$data->conversationId = $conversation->id;

			// Send to all parties involved
			foreach ($conversation->users as $userId) {
				foreach ($this->userIdConnectionMap[$userId] as $otherConnection) {
					/** @var WebSockets_User $otherConnection */
					$otherConnection->send($data);
				}
			}

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

				$data->read = [];
				$data->authorId = $user->getUserId();
				$data->createdAt = date('Y-m-d H:i:s');
				$data->conversationId = $conversation->id;

				// Store in db
				$dbChatMessage = ChatMessage::fromArray((array)$data);
				$dbChatMessage->save();

				// Send message to all users' connections
				foreach ($conversation->users as $userId) {
					foreach ($this->userIdConnectionMap[$userId] as $otherConnection) {
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
			}
		}
	}
}