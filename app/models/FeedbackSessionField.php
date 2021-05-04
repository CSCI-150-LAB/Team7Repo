<?php

/**
 * @Table('feedback_session_fields')
 */
class FeedbackSessionField extends CachedModel {
	/**
	 * @Key
	 * @AutoIncrement
	 */
	public $id;

	/**
	 * @Column('feedback_session_id')
	 */
	public $feedbackSessionId;

	/**
	 * @Column('field_type')
	 * @var FormFieldTypeEnum
	 */
	public $type;

	public $label;

	/**
	 * @JSON
	 * @Nullable
	 * @var array
	 */
	public $options;

	/**
	 * @DataType('bool')
	 * @Nullable
	 * @var boolean
	 */
	public $optional;

	/**
	 * @JSON
	 * @var array
	 */
	public $answer;

	public function __construct($args = []) {
		$this->label = $args['label'] ?? '';
		$this->type = $args['type'];
		$this->options = $args['options'] ?? null;
		$this->optional = $args['optional'] ?? false;
	}

	public function hasAnswer() {
		return !is_null($this->answer);
	}
}