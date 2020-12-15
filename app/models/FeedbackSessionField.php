<?php

/**
 * @Table('feedback_session_fields')
 */
class FeedbackSessionField extends Model {
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
	 * @var array
	 */
	public $options;

	/**
	 * @var boolean
	 */
	public $optional;

	public function __construct($args = []) {
		$this->label = $args['label'] ?? '';
		$this->type = $args['type'];
		$this->options = $args['options'] ?? null;
		$this->optional = $args['optional'] ?? false;
	}

	protected function getProp($prop) {
		if ($prop == 'options' && !is_string($this->options)) {
			return $this->options
				? json_encode($this->options)
				: null;
		}

		return parent::getProp($prop);
	}

	protected function setProp($prop, $value) {
		if ($prop == 'options') {
			if (is_string($value)) {
				$this->$prop = json_decode($value, true);
			}
			else {
				$this->$prop = [];
			}
		}
		elseif ($prop == 'optional') {
			$this->optional = !!$value;
		}
		else {
			parent::setProp($prop, $value);
		}
	}
}