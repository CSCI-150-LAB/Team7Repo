<?php

/**
 * @Table('studentreponses')
 */
class ResponseModel extends Model {

	/**
	 * @Key
	 * @Column('id')
	 */
	public $responseid;

	/**
	 * @Column('feedback_id')
	 */
	public $feedbackid;

	/**
	 * @Column('student_id')
	 */
    public $studentid;
    
    /**
	 * @Column('response')
	 */
	public $response;

	
}