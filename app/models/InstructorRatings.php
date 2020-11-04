<?php

/**
 * @Table('instructorratings')
 */
class InstructorRatings extends Model {

	/**
	 * @Key
	 * @Column('rating_id')
	 */
	public $ratingId;

	/**
	 * @Column('rating')
	 */
    public $rating;
    
    /**
     * @Column('recommendation')
     */
    public $recommendation;

    /**
     * @Column('anon')
     */
    public $anon;

    /**
     * @Column('author_id')
     */
    public $authorId;

    /**
     * @Column('instructor_id')
     */
    public $instructorId;

    /**
     * @Column('take_again')
     */
    public $takeAgain;

    /**
     * @Column('homework')
     */
    public $homework;

    /**
     * @Column('attendance_required')
     */
    public $attendanceRequired;

    /**
     * @Column('grade')
     */
    public $grade;

    /**
     * @Column('verified')
     */
    public $verified;


}