<?php

/**
 * @Table('test_conversations')
 */
class ChatConversation extends Model {

	/**
	 * @Key
	 * @AutoIncrement
	 */
	public $id;

	/**
	 * @Column('user1')
	 */
	public $userId1;

	/**
	 * @Column('user2')
	 */
    public $userId2;

	/**
	 * Gets an array of sorted messages in this conversation
	 *
	 * @return ChatMessage[]
	 */
	public function getMessages() {
		return ChatMessage::query("
			SELECT
				*
			FROM
				test_conversation_messages as cm
			WHERE
				cm.conversation_id = :0:
			ORDER BY
				created_at ASC
		", $this->id);
	}

	/**
	 * Returns the user id of the other party as given
	 *
	 * @param int $oneUser
	 * @return int
	 */
	public function getOtherUser($oneUser) {
		if ($this->userId1 == $oneUser) {
			return $this->userId2;
		}
		elseif ($this->userId2 == $oneUser) {
			return $this->userId1;
		}

		return 0;
	}

	/**
	 * Fetches or creates a conversation between two users
	 *
	 * @param int $userId1
	 * @param int $userId2
	 * @return static
	 */
	public static function getConversation($userId1, $userId2, $create = false) {
		$record = self::findOne('(userId1 = :0: AND userId2 = :1:) OR (userId1 = :1: AND userId2 = :0:)', $userId1, $userId2);

		if (!$record && $create) {
			$record = new self();
			$record->userId1 = $userId1;
			$record->userId2 = $userId2;
			$record->save();
		}

		return $record;
	}
}