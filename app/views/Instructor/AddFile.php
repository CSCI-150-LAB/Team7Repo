<?php 
    $this->pageTitle("AddFile");

	$class = InstructorClasses::find("classid =:0:", $classid);

    $statusMsg = 'Nice! We got your file.';
?>
<div style="position: fixed; top: 20%; left: 25%";> 
    <div class=""style="padding-top: 25px;"> 
        <div class="card" style="width: 45rem; padding-top: 25px;">
        <h2 class="card-title text-center"> Add a file for <?php echo $class[0]->class ?></h2>
        <div class="card-body">
            <form action="<?php echo $this->baseUrl("/Instructor/AddFile/{$classid}") ?>" class ="addingcoursefile" method="POST" enctype="multipart/form-data">
                <input type="file" name="course-file" id="course-file"> <br></br>
                <input type="submit" value="Upload " name="submit" >
            </form>
            </div>
        </div>
    </div>
</div>
