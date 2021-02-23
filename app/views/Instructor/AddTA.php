<?php
	$this->pageTitle("Add TA");

	$class = [];
	$class = InstructorClasses::find("classid =:0:", $classid);
?>
<h1>Add a TA to <?php echo $class[0]->class ?></h1>
<form method = 'POST'>
    <div class = 'form-group'>
		<label for = 'email'>TA Email:</label>
		<input type = 'text' class = "form-control <?php echo !empty($errors['class']) ? 'is-invalid' : '' ?>" id = 'email' name = 'email' placeholder = 'ta@mail.fresnostate.edu'>
		<?php if (!empty($errors['email'])) : ?>
			<div class = 'invalid-feedback'>
				<?php echo $errors['email'] ?>
			</div>
		<?php endif; ?>
	</div>
    <br>
	<input type = 'submit' class = 'btn btn-primary' name = 'add ta' value = 'Add TA'>
</form> <!--Submit button-->