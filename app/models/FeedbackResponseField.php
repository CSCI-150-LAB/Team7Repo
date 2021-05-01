<?php

/**
 * @Table('feedback_response_field')
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

	private $_correct = null;

	public function isCorrect() {
		if (is_null($this->_correct)) {
			$sessionField = FeedbackSessionField::getByKey($this->feedbackSessionFieldId);
			if (is_null($sessionField->answer)) {
				throw new Exception('This response is not part of a quiz');
			}
	
			switch ($sessionField->type) {
				case FormFieldTypeEnum::CHECKBOX_GROUP():
					$states = explode(',', $this->response);
					$this->_correct = $states == $sessionField->answer;
					break;
	
				default:
					$this->_correct = in_array($this->response, $sessionField->answer);
					break;
			}
		}

		return $this->_correct;
	}
}