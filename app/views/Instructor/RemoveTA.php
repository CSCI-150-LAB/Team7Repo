<br>
<?php
	$this->pageTitle("Remove TA");

	$class = [];
	$class = InstructorClasses::find("classid =:0:", $classid);
    $ta = User::find("id =:0:", $class[0]->TAid);
?>
<h2>Are you sure you want to remove <?php echo $ta[0]->getFullName()?> as TA from <?php echo $class[0]->class?>?</h2>
<form method = 'POST'>
    <div class = 'form-group'>
    <br>
	<input type = 'submit' class = 'btn btn-primary' name = 'remove' value = 'Remove TA'>
    <input type = 'submit' class = 'btn btn-primary' name = 'remove' value = 'Cancel'>
    </div>
</form>