<?php $class = [];
var_dump($errors);
        $class = InstructorClasses::find("classid =:0:", $classid); ?>
<h1>Add a New Student to <?php echo $class[0]->class ?></h1>
<form method = 'POST'>
    <!--Once submitted, save to database by sending to controller-->
    Student Email:
    <input type = 'text' name = 'email'>
    <br>
	<input type = 'submit' name = 'add student' value = 'Add Student'>
</form> <!--Submit button-->