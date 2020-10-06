<?php

/**
 * @Table('instructorclasses')
 */
class InstructorClasses extends Model {

	/**
	 * @Key
	 * @Column('class_id')
	 */
	public $classid;

	/**
	 * @Column('instructor_id')
	 */
	public $instructorid;

	/**
	 * @Column('class_title')
	 */
	public $class;

	/**
	 * @Column('class_description')
	 */
    public $description;

    /**
	 * @Column('start_time')
	 */
    public $starttime;

    /**
	 * @Column('end_time')
	 */
    public $endtime;

    /**
	 * @Column('monday')
	 */
	public $Mon;

    /**
	 * @Column('tuesday')
	 */
	public $Tue;

    /**
	 * @Column('wednesday')
	 */
	public $Wed;

    /**
	 * @Column('thursday')
	 */
	public $Thur;

    /**
	 * @Column('friday')
	 */
	public $Fri;

    /**
	 * @Column('saturday')
	 */
	public $Sat;

    /**
	 * @Column('sunday')
	 */
	public $Sun;
}