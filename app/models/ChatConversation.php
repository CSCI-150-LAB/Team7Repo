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
	 * @return int[]
	 */
	public function getOtherUsers($oneUser) {
		return array_filter($this->users, function($userId) use ($oneUser) {
			return $userId != $oneUser;
		});
	}

	/**
	 * Fetches or creates a conversation between two users
	 *
	 * @param int[] $users
	 * @return static
	 */
	public static function getConversation($users, $create = false) {
		$users = array_unique($users);
		sort($users);

		$record = self::findOne('users = :0:', implode(',', $users));

		if (!$record && $create) {
			$record = new self();
			$record->users = $users;
			$record->save();
		}

		return $record;
	}

	protected function getProp($prop) {
		if ($prop == 'users' && is_array($this->$prop)) {
			return implode(',', $this->$prop);
		}

		return parent::getProp($prop);
	}

	protected function setProp($prop, $value) {
		if ($prop == 'users') {
			$this->$prop = is_array($value)
				? $value
				: explode(',', $value);
		}
		else {
			parent::setProp($prop, $value);
		}
	}
}