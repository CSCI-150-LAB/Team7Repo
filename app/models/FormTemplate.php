<?php

/**
 * @Table('test_forms')
 */
class FormTemplate extends Model {
	/**
	 * @Key
	 * @AutoIncrement
	 * @var int
	 */
	public $id;

	/**
	 * @var FormField[]
	 */
	public $fields = [];

	/**
	 * @Column('author_id')
	 * @var int
	 */
	public $authorId;

	protected function getProp($prop) {
		if ($prop == 'fields' && !is_string($this->$prop)) {
			return serialize($this->$prop);
		}

		return parent::getProp($prop);
	}

	protected function setProp($prop, $value) {
		if ($prop == 'fields') {
			if (is_string($value)) {
				$this->$prop = unserialize($value);
			}
			else {
				$this->$prop = [];
			}
		}
		else {
			parent::setProp($prop, $value);
		}
	}
}