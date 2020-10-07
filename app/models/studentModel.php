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
	 * @Column('major')
	 */
	public $studentMajor;

	/**
	 * @Column('learning_style')
	 */
	public $learningStyle;


}