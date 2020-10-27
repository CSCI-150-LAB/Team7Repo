<?php $class = [];
var_dump($errors);
        $class = InstructorClasses::find("classid =:0:", $classid); ?>
<h1>Add New Students using a CSV file to <?php echo $class[0]->class ?></h1>

<form method="post">

<div class = 'form-group'>
		<label for = 'file'>Select CSV File:</label>
		<input type = 'file' class = "form-control <?php echo !empty($errors['class']) ? 'is-invalid' : '' ?>" id = 'file' name = 'file'>
		<?php if (!empty($errors['file'])) : ?>
			<div class = 'invalid-feedback'>
				<?php echo $errors['file'] ?>
			</div>
		<?php endif; ?>
	</div>
    <br>
<input type = 'submit' class = 'btn btn-primary' name = 'add students' value = 'Add Students'>

</form>