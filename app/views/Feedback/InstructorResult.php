<?php if (count($aggregates)) : ?>
	<h3>Aggregate Results</h3>
	<table class="table aggregate-results">
		<thead>
			<tr>
				<th>Question</th>
				<th>Results</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($aggregates as $fieldId => $results) : ?>
				<?php $field = $fields[$fieldId]; ?>
				<tr>
					<td>
						<?php echo $field->label ?>
					</td>
					<td>
						<div class="response-percent">
							<span class="percent"><?php echo round($results['responders'] / $totalResponses * 100, 2) ?></span> responded to this question
						</div>

						<?php if ($field->type == FormFieldTypeEnum::RATING()) : ?>
							<div class="rating-picks mb-2">
								<?php $sum = 0; ?>
								<?php for ($i = 1; $i <= 5; $i++) : $sum += $results['data'][$i] * $i ?>
									<div class="response-percent">
										<span class="percent"><?php echo round($results['data'][$i] / $results['responders'] * 100, 2) ?></span>
										<?php for ($j = 0; $j < $i; $j++) : ?>
											<i class="fas fa-star"></i>
										<?php endfor; ?>
									</div>
								<?php endfor; ?>
							</div>
							<div class="rating-score">
								<div class="label">Total Rating:</div>
								<?php echo PrintHelpers::printStarRating($sum / $results['responders']); ?>
							</div>
						<?php else : ?>
							<div class="option-picks">
								<?php foreach ($field->options as $ndx => $label) : ?>
									<div class="response-percent">
										<span class="percent"><?php echo round($results['data'][$ndx] / $results['responders'] * 100, 2) ?></span> <?php echo $label ?>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>

<?php foreach ($allResponses as $response) : ?>
	<div class="student-response">
		<div class="name"><?php echo User::getByKey($response->studentid)->getFullName() ?></div>
		<?php $response->printResponse() ?>
	</div>
<?php endforeach; ?>