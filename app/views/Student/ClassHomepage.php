<?php
	$this->pageTitle('View Class');

?>
<div class="mb-3 p-5 text-white bg-blue"> 
	<div class = "row">
		<h1 class="mb-0 text-white"> Welcome to <?php echo $class->class ?>'s Homepage</h1> <br> </br>
        <!-- <h1 class="mb-3 text-white">  </h1> -->
	</div>
	<div class = "row">
		 <h5 class="mb-0"> Day and Time: <?php echo  $class->getClassTimeString(); ?></h5> 
	</div>
</div>
<div class="row">
<!--Student Menu-->
    <div class = "col-sm-3">
        <div class="accordion">
            <div class="card">
            <!-- View Feedback Sessions -->
                <div class="card-header"> Feedback Sessions <button class="btn btn-secondary float-right" type="button"> <a href="<?php echo $this->baseUrl("/Feedback/PublishedFeedback/{$class->classid}") ?>" style="color: #ffffff;"> <i class="fas fa-chevron-right"></i></a> </button> </div>
            </div>
            <!-- Course Materials -->
            <div class = "card">
                <div class="card-header"> Course Materials <button class="btn btn-secondary float-right" type="button"> <a href="<?php echo $this->baseUrl("/Instructor/CourseMaterials/{$class->classid}") ?>" style="color: #ffffff;"> <i class="fas fa-chevron-right"></i></a> </button> </div>
            </div>
            <!-- Class Quizzes -->
            <div class="card">
                <div class="card-header"> Quizzes <button class="btn btn-secondary float-right" type="button"> <a href="#>" style="color: #ffffff;"> <i class="fas fa-chevron-right"></i></a> </button> </div>
            </div>
            <!-- Class  Whiteboard
            <div class = "card">
                <div class="card-header"> View Whitebaord <button class="btn btn-secondary float-right" type="button"> <a href="#" style="color: #ffffff;"> <i class="fas fa-chevron-right"></i></a> </button> </div>
            </div> -->
    </div>
    </div>
    <div class = "col">
        <div class="card">
            <div class="card-body">

        <?php 
            if(true) { ?>

                <h4 class="card-title"> <b> CSCI 150. Introduction to Software Engineering </b></h4>
                <p class="card-text">Prerequisite: CSCI 41. History, goals, and motivation of software engineering. Study and use of software engineering methods. Requirements, specification, design, implementation, testing, verification, and maintenance of large software systems. Team programming. (2 lecture, 3 lab hours)</p>
                <p><b>Units:</b> 3 | <b>Course Typically Offered:</b> Fall</p>
                
                <a href="http://www.fresnostate.edu/catalog/courses-by-department/computer-science/index.html" class="btn btn-danger">Go to Course Catalog</a>
                <?php }?>

            </div>
        </div>
    </div>
</div>