<?php
	$this->pageTitle("Edit Profile");
	var_dump($errors);
?>

<h1>Edit Your Profile</h1>
<form method = 'POST'>
    <!--Once submitted, save to database by sending to controller-->
    <div class="form-group">
		<label for="department">Department:</label>
		<input type="text" class="form-control <?php echo !empty($errors['class']) ? 'is-invalid' : '' ?>" id="department" name="department" placeholder="Math" <?php echo "value = '".$profile->department."'"; ?>>
		<?php if (!empty($errors['department'])) : ?>
			<div class="invalid-feedback">
				<?php echo $errors['department'] ?>
			</div>
		<?php endif; ?>
	</div>
    <br>
    <!--Input for user's department-->
	<div class="form-row">
		<div class="form-group col-md-4">
			<label>Preferred Title:</label>
		</div>
		<div class="form-group col-md-8">
			<!--Selection of user's preferred title, autoselects if previously chosen-->
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='name1' name = 'name' value = 'Dr.'
					<?php   if($profile->name == 'Dr.') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='name1'>Dr.</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='name2' name = 'name' value = 'Professor'
					<?php   if($profile->name == 'Professor') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='name2'>Professor</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='name3' name = 'name' value = 'Mr.'
					<?php   if($profile->name == 'Mr.') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='name3'>Mr.</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='name4' name = 'name' value = 'Mrs.'
					<?php   if($profile->name == 'Mr2.') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='name4'>Mrs.</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='name5' name = 'name' value = 'Ms.'
					<?php   if($profile->name == 'Ms.') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='name5'>Ms.</label>
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label>Visual Style Usage:</label>
		</div>
		<div class="form-group col-md-8">
			<!--Selection of user's visual style usage, autoselects if previously chosen-->
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='visual1' name = 'visual' value = 'Primarily'
					<?php   if($profile->visual == 'primarily') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='visual1'>Primarily</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='visual2' name = 'visual' value = 'Somewhat'
					<?php   if($profile->visual == 'somewhat') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='visual2'>Somewhat</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='visual3' name = 'visual' value = 'Minimal'
					<?php   if($profile->visual == 'minimal') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='visual3'>Minimal</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='visual4' name = 'visual' value = 'Not at all'
					<?php   if($profile->visual == 'not at all') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='visual4'>Not at all</label>
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label>Auditory Style Usage:</label>
		</div>
		<div class="form-group col-md-8">
			<!--Selection of user's auditory style usage, autoselects if previously chosen-->
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='auditory1' name = 'auditory' value = 'Primarily'
					<?php   if($profile->auditory == 'primarily') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='auditory1'>Primarily</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='auditory2' name = 'auditory' value = 'Somewhat'
					<?php   if($profile->auditory == 'somewhat') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='auditory2'>Somewhat</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='auditory3' name = 'auditory' value = 'Minimal'
					<?php   if($profile->auditory == 'minimal') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='auditory4'>Minimal</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='auditory4' name = 'auditory' value = 'Not at all'
					<?php   if($profile->auditory == 'not at all') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='auditory3'>Not at all</label>
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label>Reading and Writing Style Usage:</label>
		</div>
		<div class="form-group col-md-8">
			<!--Selection of user's reading/writing style usage, autoselects if previously chosen-->
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='readwrite1' name = 'readwrite' value = 'Primarily'
					<?php   if($profile->readwrite == 'primarily') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='readwrite1'>Primarily</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='readwrite2' name = 'readwrite' value = 'Somewhat'
					<?php   if($profile->readwrite == 'somewhat') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='readwrite2'>Somewhat</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='readwrite3' name = 'readwrite' value = 'Minimal'
					<?php   if($profile->readwrite == 'minimal') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='readwrite3'>Minimal</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='readwrite4' name = 'readwrite' value = 'Not at all'
					<?php   if($profile->readwrite == 'not at all') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='readwrite4'>Not at all</label>
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label>Kinesthetic Style Usage:</label>
		</div>
		<div class="form-group col-md-8">
			<!--Selection of user's kinesthetic style usage, autoselects if previously chosen-->
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='kines' name = 'kines' value = 'Primarily'
					<?php   if($profile->kines == 'primarily') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='kines1'>Primarily</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='kines2' name = 'kines' value = 'Somewhat'
					<?php   if($profile->kines == 'somewhat') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='kines2'>Somewhat</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='kines3' name = 'kines' value = 'Minimal'
					<?php   if($profile->kines == 'minimal') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='kines3'>Minimal</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='kines4' name = 'kines' value = 'Not at all'
					<?php   if($profile->kines == 'not at all') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='kines4'>Not at all</label>
			</div>
		</div>
	</div>
	<input type = 'submit' class = 'btn btn-primary' name = 'save changes' value = 'Save Changes'>
</form> <!--Submit button-->