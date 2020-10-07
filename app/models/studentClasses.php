<?php

/**
 * @Table('classes')
 */
class studentClasses extends Model {

	/**
	 * @Key
	 * @Column('class_id')
	 */
	public $classId;

	/**
	 * @Column('student_id')
	 */
	public $studentId;

}