
<style>
    textarea {
        resize: none;
    }
</style>

<div class="bg-blue text-white mb-3 p-5">
	<h1 class="mb-0"> Feedback Response</h1>
</div>

<button class = 'btn btn-secondary float-md-right text-white' data-start-tour="Respond to Feedback Session Tour">Help</button><br><br> 

<div class = "card feedsession">
<div class = "card-body">
<form method="POST" class="feedback-response">
	<div class="preload-area">
		<i class="fas fa-star"></i>
	</div>
	<?php
		$formBuilder = new FormBuilder($errors, $_POST);
		$formBuilder->getError('_form');

		foreach ($fields as $field) {
			/** @var FeedbackSessionField $field */ 
			$label = '<span class="' . ($field->optional ? 'optional' : 'required') . '">' . $field->label . '</span>';
			
			switch ($field->type) {
				case FormFieldTypeEnum::SHORT_TEXT():
					?><div class = "shorttext"><?php
					$formBuilder->formGroup(function(FormBuilder $builder) use ($field, $label) {
						$builder->inputField("field{$field->id}", $label);
					}); ?></div><?php
					break;
				case FormFieldTypeEnum::LONG_TEXT():
					?><div class = "longtext"><?php
					$formBuilder->formGroup(function(FormBuilder $builder) use ($field, $label) {
						$builder->textareaField("field{$field->id}", $label);
					});?></div><?php
					break;
				case FormFieldTypeEnum::RADIO_GROUP():
					?><div class = "radiogroup"><?php
					$formBuilder->radioGroup($label, function(FormBuilder $builder) use ($field) {
						foreach ($field->options as $ndx => $option) {
							$builder->radio("field{$field->id}", $ndx, $option, false);
						}
					});?></div><?php
					break;
				case FormFieldTypeEnum::CHECKBOX_GROUP():
					?><div class = "checkboxgroup"><?php
					$formBuilder->checkboxGroup($label, function(FormBuilder $builder) use ($field) {
						foreach ($field->options as $ndx => $option) {
							$builder->checkbox("field{$field->id}[]", $option, $ndx, false);
						}
					});?></div><?php
					break;
				case FormFieldTypeEnum::RATING():
					?><div class = "ratingquestion"><?php
					$formBuilder->formGroup(function(FormBuilder $builder) use ($field, $label, $errors) {
						$fieldName = "field{$field->id}";
						?>
						<label><?php echo $label ?></label>
						<div class="rating-field-container <?php echo isset($errors[$fieldName]) ? 'is-invalid' : ''?>">
							<div class="rating-field">
								<?php $builder->hiddenField("field{$field->id}") ?>
								<?php for ($i = 1; $i <= 5; $i++) : ?>
								<i class="far fa-star score-<?php echo $i ?>"></i>
								<?php endfor; ?>
							</div>
							<?php if (!empty($errors[$fieldName])) : ?>
								<div class="invalid-feedback">
									<?php echo $errors[$fieldName] ?>
								</div>
							<?php endif; ?>
						</div>
						<?php
					});?></div><?php
					break;
			}
		}
	?>

	<button type="submit" class="btn btn-primary submitfeedback">Submit</button>

</form>
</div>
</div>
