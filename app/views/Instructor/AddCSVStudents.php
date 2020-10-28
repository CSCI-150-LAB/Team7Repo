<?php $class = [];
var_dump($errors);
        $class = InstructorClasses::find("classid =:0:", $classid); ?>
<h1>Add New Students using a CSV file to <?php echo $class[0]->class ?></h1>

<form method="post" enctype="multipart/form-data">

<div class = 'form-group'>
		<label for = 'csv'>Select CSV File:</label>
		<input type = 'file' class = "form-control <?php echo !empty($errors['class']) ? 'is-invalid' : '' ?>" id = 'csv' name = 'csv'>
		<?php if (!empty($errors['csv'])) : ?>
			<div class = 'invalid-feedback'>
				<?php echo $errors['csv'] ?>
			</div>
		<?php endif; ?>
	</div>
    <br>
<input type = 'submit' class = 'btn btn-primary' name = 'add students' value = 'Add Students'>

</form>