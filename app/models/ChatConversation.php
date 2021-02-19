<?php

/**
 * @Table('conversations')
 */
class ChatConversation extends Model {

	/**
	 * @Key
	 * @AutoIncrement
	 */
	public $id;

	/**
	 * @Column('users')
	 */
	public $users;

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
				conversation_messages as cm
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
		$otherUsers = [];
		foreach($this->users as $user) {
			if($oneUser != $user) {
				$otherUsers[] = $user;
			}

		return $otherUsers;
	}

	/**
	 * Fetches or creates a conversation between two users
	 *
	 * @param int $userId1
	 * @param int $userId2
	 * @return static
	 */
	public static function getConversation($users, $create = false) {
		$record = self::findOne('users = :0:', $users);

		if (!$record && $create) {
			$record = new self();
			$record->users = $users;
			$record->save();
		}

		return $record;
	}
}