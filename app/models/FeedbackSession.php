<?php
/**
 * @Table('feedback_sessions')
 */
class FeedbackSession extends Model {

	/**
	 * @Key
	 * @AutoIncrement
	 */
	public $id;

	public $title;

	/**
	 * @Column('class_id')
	 */
	public $classid;

	/**
	 * @Column('start_time')
	 */
	public $startTime;

	/**
	 * @Column('end_time')
	 */
	public $endTime;

	/**
	 * @Column('is_quiz')
	 * @DataType('bool')
	 * @var boolean
	 */
	public $isQuiz;

	/**
	 * @Column('created_on')
	 */
	public $createdDate;
}