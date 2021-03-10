<?php
	$this->pageTitle("Edit Profile");
?>

<h1>Edit Your Profile</h1>
<button class = 'btn btn-secondary float-md-right text-white' onclick = 'instrProfEditTut()'>Help</button><br><br>
<form class = 'editinstructorprofile' method = 'POST'>
    <!--Once submitted, save to database by sending to controller-->
    <div class="form-group department">
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
	<div class="form-row titlename">
		<div class="form-group col-md-4">
			<label>Preferred Title:</label>
		</div>
		<div class="form-group col-md-8">
			<!--Selection of user's preferred title, autoselects if previously chosen-->
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='name1' name = 'name' value = 'Dr.'
					<?php   if($instructor->preferredTitle == 'Dr.') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='name1'>Dr.</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='name2' name = 'name' value = 'Professor'
					<?php   if($instructor->preferredTitle == 'Professor') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='name2'>Professor</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='name3' name = 'name' value = 'Mr.'
					<?php   if($instructor->preferredTitle == 'Mr.') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='name3'>Mr.</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='name4' name = 'name' value = 'Mrs.'
					<?php   if($instructor->preferredTitle == 'Mr2.') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='name4'>Mrs.</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" id='name5' name = 'name' value = 'Ms.'
					<?php   if($instructor->preferredTitle == 'Ms.') {
						echo "checked = 'checked'";
					} ?>
			>
				<label class="form-check-label" for='name5'>Ms.</label>
			</div>
		</div>
	</div>
	<div class="teachingstyles">
		<div class="form-row visual">
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
		<div class="form-row auditory">
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
		<div class="form-row readwrite">
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
		<div class="form-row kinesthetic">
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
	</div>
	<input type = 'submit' class = 'btn btn-primary savebutton' name = 'save changes' value = 'Save Changes'>
</form> <!--Submit button-->

<script>
	function instrProfEditTut(){
		// Declare the tour
		var instructorProfileEditTutorial = new Tour({
			name: "instructor-edit-tour",
			container: "body",
			smartPlacement: true,
			backdrop: true,
			backdropPadding: 5,
			//duration: 10000,
			storage: false,
			template: (i, step) => `
				<div class="popover" role="tooltip">
					<div class="arrow"></div>
					<h3 class="popover-header" data-progress="${i + 1} / ${instructorProfileEditTutorial._options.steps.length}"></h3>
					<div class="popover-body"></div>
					<div class="popover-navigation">
						<div class="btn-group">
							<button class="btn btn-sm btn-secondary" data-role="prev"><< Prev</button>
							<button class="btn btn-sm btn-secondary" data-role="next">Next >></button>
							<button class="btn btn-sm btn-secondary" data-role="pause-resume" data-pause-text="Pause" data-resume-text="Resume">Pause</button>
						</div>
						<button class="btn btn-sm btn-secondary" data-role="end">End tour</button>
					</div>
				</div>
			`,
			steps: [
            {
                element: ".editinstructorprofile",
                title: "Edit your profile here!",
				next: 1,
				prev:-1,
                content: "This is where you can first create, edit, or update your instructor profile."
            },
            {
                element: ".department",
                title: "Change your department",
				next: 2,
				prev: 0,
                content: "Here is where you can type in the name of the department you work for, you can use an abbreviation or type it out fully, whatever you decide."
            },
            {
                element: ".titlename",
                title: "Preferred Title",
				next: 3,
				prev: 1,
                content: "Select your preferred title for how you are addressed.  You can only select one, but if you change your mind you can always come back and change it later."
            },
			{
				element: ".teachingstyles",
				title: "Select Teaching Styles",
				next: 4,
				prev: 2,
				content: "Here is where you select your usage of each teaching style.  We recommend you be as accurate as possible so students have a better idea of how your class is run."
			},
			{
				element: ".visual",
				title: "Visual Teaching",
				next: 5,
				prev: 3,
				content: "Visual teaching broadly refers to any teaching that uses visuals.  Commonly this includes lecture slides, videos, and other visual aids.  Select how often you believe you use these types of materials when teaching here."
			},
			{
				element: ".auditory",
				title: "Auditory Teaching",
				next: 6,
				prev: 4,
				content: "Auditory teaching broadly refers to any teaching that uses sound.  Commonly this includes lectures, videos, music, and other things you listen to.  Select how often you believe you use these types of materials when teaching here."
			},
			{
				element: ".readwrite",
				title: "Reading and Writing Teaching",
				next: 7,
				prev: 5,
				content: "Reading and writing teaching broadly refers to any teaching where students can read and write while learning.  Commonly this includes when students take notes, but can also refer to writing essays, responses to quizzes, assigning textbook reading, and so on.  Select how often you believe you use these types of materials when teaching here."
			},
			{
				element: ".kinesthetic",
				title: "Kinesthetic Teaching",
				next: 8,
				prev: 6,
				content: "Kinesthetic teaching broadly refers to any teaching that encourages students to participate.  Commonly this includes homework assignments, quizzes, labs, and other activities where students get a hands-on experience.  Select how often you believe you use these types of materials when teaching here"
			},
			{
				element: ".savebutton",
				title: "Submit",
				next: -1,
				prev: 7,
				content: "When you are done with editting your profile, you can click here to save it and it will redirect you back to your profile to view."
			}]
        });
	  
		// Initialize the tour
		instructorProfileEditTutorial.init();
	  
		// Start the tour
		instructorProfileEditTutorial.restart();
	  
	};
</script>