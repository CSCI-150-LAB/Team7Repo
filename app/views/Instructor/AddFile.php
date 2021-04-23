<?php 
    $this->papgeTitle("AddFile"); 
?>


<h2> Add a file to course materials</h2>
<p>Please, go ahead.</p>

<form action="<?php echo $this->baseUrl("/Instructor/CourseMaterials") ?>" class ="addingcoursefile" method="POST" enctype="multipart/form-data">
  
    <input type="file" name="course-file" id="course-file">
    <input type="submit" value="Submit Upload Please" name="submit">
</form>

