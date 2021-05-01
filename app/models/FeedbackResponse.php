<?php

/**
 * @Table('feedback_responses')
 */
class FeedbackResponse extends Model {

	/**
	 * @Key
	 * @AutoIncrement
	 */
	public $id;

	/**
	 * @Column('feedback_session_id')
	 */
	public $feedbackSessionId;

	/**
	 * @Column('student_id')
	 */
    public $studentid;
    
    /**
	 * @Column('created_on')
	 */
	public $createdDate;

	/**
	 * Prints a table with the user responses
	 * Forgive me for this mess... I'm sleepy
	 *
	 * @return void
	 */
	public function printResponse() {
		$feedbackSession = FeedbackSession::getByKey($this->feedbackSessionId);
		if (!$feedbackSession) {
			return;
		}

		$feedbackSessionFields = FeedbackSessionField::find('feedback_session_id = :0:', $this->feedbackSessionId);
		/** @var FeedbackResponseField[] */
		$responseFields = [];
		foreach (FeedbackResponseField::find('feedback_response_id = :0:', $this->id) as $responseField) {
			$responseFields[$responseField->feedbackSessionFieldId] = $responseField;
		}

		?>
		
		<div class="table-responsive feedback-response-listing my-4" data-id="<?php echo $this->id ?>">
			<table class="table table-sm bg-white shadow-sm border">
				<caption style="caption-side:top"><?php echo $feedbackSession->title ?></caption>
				<thead>
					<tr>
						<th>Question</th>
						<th>Response</th>
						<?php if ($feedbackSession->isQuiz) : ?>
							<th>Correct Answer</th>
						<?php endif; ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($feedbackSessionFields as $field) : ?>
						<?php
							$classedType = strtolower(str_replace('_', '-', $field->type));
							$isAnswer = $feedbackSession->isQuiz && in_array($responseFields[$field->id]->response, $field->answer);
						?>
						<tr>
							<td>
								<?php echo $field->label ?>
							</td>
							<td class="field-type-<?php echo $classedType ?>">
								<?php if (isset($responseFields[$field->id])) : ?>
									<?php if ($field->type == FormFieldTypeEnum::CHECKBOX_GROUP()) : ?>
										<?php
											$checkedIndexes = explode(',', $responseFields[$field->id]->response);
											$countChecked = count(array_filter($checkedIndexes));
										?>
										<?php if ($countChecked) : ?>
											<?php foreach ($field->options as $ndx => $option) : ?>
												<?php
													$isAnswer = $feedbackSession->isQuiz && $field->answer[$ndx];
												?>
												<?php if ($checkedIndexes[$ndx]) : ?>
													<div class="checked-option">
														<?php if ($feedbackSession->isQuiz && !$isAnswer) : ?>
															<del class="wrong-answer">
														<?php endif; ?>
														<?php echo $option ?>
														<?php if ($feedbackSession->isQuiz) : ?>
															<?php if ($isAnswer) : ?>
																<span class="fa fa-check text-success"></span>
															<?php else : ?>
																<span class="badge badge-danger">wrong</span>
															<?php endif; ?>
														<?php endif; ?>
														<?php if ($feedbackSession->isQuiz && !$isAnswer) : ?>
															</del>
														<?php endif; ?>
													</div>
												<?php elseif ($isAnswer) : ?>
													<?php echo $option ?> <span class="badge badge-success">correct</span>
												<?php endif; ?>
											<?php endforeach; ?>
										<?php endif; ?>
									<?php elseif ($field->type == FormFieldTypeEnum::RADIO_GROUP()) : ?>
										<?php if ($feedbackSession->isQuiz && !$isAnswer) : ?>
											<del class="wrong-answer">
										<?php endif; ?>
										<?php echo $field->options[$responseFields[$field->id]->response] ?>
										<?php if ($feedbackSession->isQuiz) : ?>
											<?php if ($isAnswer) : ?>
												<span class="fa fa-check text-success"></span>
											<?php else : ?>
												<span class="badge badge-danger">wrong</span>
											<?php endif; ?>
										<?php endif; ?>
										<?php if ($feedbackSession->isQuiz && !$isAnswer) : ?>
											</del>
										<?php endif; ?>
									<?php elseif ($field->type == FormFieldTypeEnum::RATING()) : ?>
										<?php echo PrintHelpers::printStarRating($responseFields[$field->id]->response); ?>
									<?php else : ?>
										<?php if ($feedbackSession->isQuiz && !$isAnswer) : ?>
											<del class="wrong-answer">
										<?php endif; ?>
										<?php echo $responseFields[$field->id]->response ?>
										<?php if ($feedbackSession->isQuiz) : ?>
											<?php if ($isAnswer) : ?>
												<span class="fa fa-check text-success"></span>
											<?php else : ?>
												<span class="badge badge-danger">wrong</span>
											<?php endif; ?>
										<?php endif; ?>
										<?php if ($feedbackSession->isQuiz && !$isAnswer) : ?>
											</del>
										<?php endif; ?>
									<?php endif; ?>
								<?php endif; ?>
							</td>
							<?php if ($feedbackSession->isQuiz) : ?>
							<td>
								<?php if ($field->type == FormFieldTypeEnum::CHECKBOX_GROUP()) : ?>
									<?php
									$first = true;
									foreach ($field->answer as $ndx => $isAns) {
										if (!$isAns) {
											continue;
										}

										if (!$first) {
											echo '<br>';
										}

										echo $field->options[$ndx];
										$first = false;
									}
									?>
								<?php elseif ($field->type == FormFieldTypeEnum::RADIO_GROUP()) : ?>
									<?= $field->options[$field->answer[0]] ?>
								<?php else : ?>
									<?= $field->answer[0] ?>
								<?php endif; ?>
							</td>
							<?php endif; ?>
						</trait>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

		<?php
	}
}