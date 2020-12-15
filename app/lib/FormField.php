<?php

class FormField implements Serializable {
	/**
	 * @var string
	 */
	public $label;

	/**
	 * @var FormFieldTypeEnum
	 */
	public $type;

	/**
	 * @var array
	 */
	public $options;

	public function __construct($args = []) {
		$this->label = $args['label'] ?? '';
		$this->type = $args['type'] ?? FormFieldTypeEnum::SHORT_TEXT();
		$this->options = $args['options'] ?? null;
	}

	public function serialize() {
		return serialize([
			'label' => $this->label,
			'type' => $this->type->__toString(),
			'options' => $this->options
		]);
	}

	public function unserialize($string) {
		$arr = unserialize($string);
		$this->label = $arr['label'];
		$this->type = FormFieldTypeEnum::__callStatic($arr['type']);
		$this->options = $arr['options'];
	}
}