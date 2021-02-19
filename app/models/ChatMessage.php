<?php

/**
 * @Table('test_conversation_messages')
 */
class ChatMessage extends Model {

	/**
	 * @Key
	 * @AutoIncrement
	 */
	public $id;

	/**
	 * @Column('conversation_id')
	 */
	public $conversationId;

	/**
	 * @Column('author_id')
	 */
	public $authorId;

	/**
	 * @Column('message')
	 */
    public $message;

	public $read;

	/**
	 * @Column('created_at')
	 */
	public $createdAt;

	protected function getProp($prop) {
		if ($prop == 'read' && !is_bool($this->$prop)) {
			return $this->$prop
				? 1
				: 0;
		}

		return parent::getProp($prop);
	}

	protected function setProp($prop, $value) {
		if ($prop == 'read') {
			$this->$prop = !!$value;
		}
		else {
			parent::setProp($prop, $value);
		}
	}
}