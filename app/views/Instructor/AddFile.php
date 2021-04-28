<?php 
    $this->pageTitle("AddFile");

    $class = [];
	$class = InstructorClasses::find("classid =:0:", $classid);

    $statusMsg = 'Nice! We got your file.';
?>


<h2> Add a file to course materials for <?php echo $class[0]->class ?></h2>


<form action="<?php echo $this->baseUrl("/Instructor/AddFile") ?>" class ="addingcoursefile" method="POST" enctype="multipart/form-data">
  <input type="file" name="course-file" id="course-file">
    <input type="submit" value="Submit Upload Please" name="submit" >
</form>

