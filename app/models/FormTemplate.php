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
	 * @Serialized
	 * @var FormField[]
	 */
	public $fields = [];

	/**
	 * @Column('author_id')
	 * @var int
	 */
	public $authorId;
}