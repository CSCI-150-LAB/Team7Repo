<?php

/**
 * @Table('studentprofile')
 */
class studentModel extends Model {

	/**
	 * @Key
	 * @Column('id')
	 */
	public $studentid;

	/**
	 * @Column('first_name')
	 */
	public $studentFirstName;

	/**
	 * @Column('last_name')
	 */
	public $studentLastName;

	/**
	 * @Column('major')
	 */
	public $studentMajor;

	/**
	 * @Column('learning_style')
	 */
	public $learningStyle;


}