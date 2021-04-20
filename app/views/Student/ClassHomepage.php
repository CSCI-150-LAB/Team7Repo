<?php
	$this->pageTitle('View Class');
?>
<div class="col mb-3 p-5 text-white bg-blue"> 
	<div class = "row">
		<h1 class="mb-3 text-white"> Welcome to CSCI 150 </h1>
        <!-- <h1 class="mb-3 text-white"> <?php echo $class->class . ": " . $class->description; ?> </h1> -->
	</div>
	<div class = "row">
        <h5> Day and Time: </h5>
		<!-- <h5> Day and Time: <?php echo  $class->getClassTimeString(); ?></h5> -->
	</div>
</div>
<div class="row mb-3">
<!--Student Menu-->
    <div class = "col-sm-3">
            <div class="accordion" id="accordionExample">

                <!-- View Feedback Sessions -->
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <div class=""> Feedback Sessions
                            <button class="btn btn-secondary float-right" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"> <i class="fas fa-chevron-down"></i></button> 
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample"> 
                            <div class="card-body">
                                <a href='<?php echo $this->baseUrl("") ?>' class="">Active Sessions</a> <br>
                                <a href='<?php echo $this->baseUrl("") ?>' class="">Past Sessions</a> <br>
                                <a href='<?php echo $this->baseUrl("") ?>' class="">My Responses</a> <br>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Course Materials -->
                <div class = "card">
                    <div class="card-header"> Course Materials <button class="btn btn-secondary float-right" type="button"> <a href="#" style="color: #ffffff;"> <i class="fas fa-chevron-right"></i></a> </button> </div>
                </div>
                <!-- Class Quizzes -->
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <div class=""> Quizzes
                            <button class="btn btn-secondary float-right" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseOne"> <i class="fas fa-chevron-down"></i></button> 
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample"> 
                            <div class="card-body">
                                <a href='<?php echo $this->baseUrl("") ?>' class="">Active Quizzes</a> <br>
                                <a href='<?php echo $this->baseUrl("") ?>' class="">My Responses</a> <br>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Class  Whiteboard -->
                <div class = "card">
                    <div class="card-header"> View Whitebaord <button class="btn btn-secondary float-right" type="button"> <a href="#" style="color: #ffffff;"> <i class="fas fa-chevron-right"></i></a> </button> </div>
                </div>
        </div>
    </div>
    <div class = "col">
        <h2><b> Quiz Overview <b></h2>
        <div class="table-responsive">
			<table class="table table-bordered tbl-background">
				<thead>
					<tr>
						<th scope="col"> Date Posted: </th>
						<th scope="col"> Quiz Details: </th>
                        <th scope="col"> Grade </th>
					</tr>
				</thead>
				<tbody>
                    <tr>
                        <td>4/12/21</td>
                        <td>Quiz 1: Chapters 2 & 3</td>
                        <td><a href="#">8/10</a></td>
                    </tr>
				</tbody>
			</table>
		</div>
    </div>
</div>