<?php

/**
 * @Table('conversation_messages')
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
		if ($prop == 'read' && is_array($this->$prop)) {
			return implode(',', $this->$prop);
		}

		return parent::getProp($prop);
	}

	protected function setProp($prop, $value) {
		if ($prop == 'read') {
			$this->$prop = is_array($value)
				? $value
				: array_filter(explode(',', $value));
		}
		else {
			parent::setProp($prop, $value);
		}
	}
}