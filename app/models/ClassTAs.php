<?php

/**
 * @Table('instructor_ta_classes')
 */
class ClassTAs extends Model {

	/**
	 * @Key
	 * @Column('class_id')
	 */
	public $classID;

	/**
	 * @Column('instructor_id')
	 */
	public $instructorID;

	/**
	 * @Column('ta_id')
	 */
	public $taID;
	
}