<?php

/**
 * @Table('new_feedback_response_field')
 */
class FeedbackResponseField extends Model {

	/**
	 * @Key
	 */
	public $id;

	/**
	 * @Column('feedback_response_id')
	 */
	public $feedbackResponseId;

	/**
	 * @Column('feedback_session_field_id')
	 */
	public $feedbackSessionFieldId;

	public $response;
}