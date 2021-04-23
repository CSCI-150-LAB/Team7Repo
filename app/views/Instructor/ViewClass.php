<?php
	$this->pageTitle('View Class');
?>
<div class="col mb-3 p-5 text-white bg-blue"> 
	<div class = "row">
		<h1 class="mb-3 text-white"> <?php echo $class->class . ": " . $class->description; ?> </h1>
	</div>
	<div class = "row">
		<h5> Day and Time: <?php echo  $class->getClassTimeString(); ?></h5>
	</div>
</div>
<div class="row mb-3">
<!--Class Menu-->
	<div class = "col-sm-3">
		<div class="accordion" id="accordionExample">
			<!-- Track Attendance-->
			<div class="card">
				<div class="card-header"> Track Attendance <button class="btn btn-danger float-right" type="button"> <a href="#" style="color: #ffffff;"> <i class="fas fa-chevron-right"></i></a> </button> </div>
			</div>
			<!-- Course Materials -->
			<div class = "card">
				<div class="card-header"> Course Materials <button class="btn btn-danger float-right" type="button"> <a href='<?php echo $this->baseUrl("/Instructor/CourseMaterials/{$class->classid}") ?>' style="color: #ffffff;"> <i class="fas fa-chevron-right"></i></a> </button> </div>
			</div>
			<!-- Add Student/TA -->
			<div class="card">
				<div class="card-header" id="headingOne">
					<div class=""> Add to Class
						<button class="btn btn-danger float-right" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"> <i class="fas fa-chevron-down"></i></button> 
					</div>
					<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample"> 
						<div class="card-body">
							<a href='<?php echo $this->baseUrl("/Instructor/AddStudent/{$class->classid}") ?>' class="">Add Student</a> <br>
							<a href='<?php echo $this->baseUrl("/Instructor/AddCSVStudents/{$class->classid}") ?>' class="">Add Students by CSV</a> <br>
							<?php
								if ($ta[0]->id == NULL) { ?>
									<a href='<?php echo $this->baseUrl("/Instructor/AddTA/{$class->classid}") ?>' class="">Add TA</a>
							<?php 
								} ?>
						</div>
					</div>
				</div>
			</div>
			<!-- Get Feedback -->
			<div class="card">
				<div class="card-header" id="headingOne">
					<div class=""> Get Feedback
						<button class="btn btn-danger float-right" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseOne"> <i class="fas fa-chevron-down"></i></button> 
					</div>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample"> 
						<div class="card-body">
							<a href="#feedback-app" class="" data-toggle="modal" data-target="#feedback-app" id="feedback-form">Create Session</a> <br>
							<a href='<?php echo $this->baseUrl("/Feedback/PublishedFeedback/{$class->classid}") ?>' class="">View Session</a>
						</div>
					</div>
				</div>
			</div>
			<!-- Create Quiz -->
			<div class = "card">
				<div class="card-header"> Create Quiz <button class="btn btn-danger float-right" type="button"> <a href="#" style="color: #ffffff;"> <i class="fas fa-chevron-right"></i></a> </button> </div>
			</div>
			<!-- Launch Whiteboard -->
			<div class = "card">
				<div class="card-header"> Launch Whiteboard <button class="btn btn-danger float-right" type="button"> <a href="#" style="color: #ffffff;"> <i class="fas fa-chevron-right"></i></a> </button> </div>
			</div>
	</div>
</div>

<!--Class Information -->
<div class ="col"> 
		<!-- TA Information -->
	 <h2> <i class="fas fa-user"></i> <b>TA:</b>
			<?php 
				if ($class->TAid == NULL) {
					echo "None";
				}
				else {
					$ta = User::find("id =:0:", $class->TAid); ?>
					 <a href = '<?php echo $this->baseUrl("/Student/Profile/{$ta[0]->id}") ?>'> <?php echo $ta[0]->firstName . " " . $ta[0]->lastName; ?></a>
					 <!--Allow instructor to remove a TA if they have one-->
					 <?php $currentUser = User::getCurrentUser(); 
								 if ($currentUser->id != $ta[0]->id) { ?>
									<button type="button" class="btn btn-outline-danger " style ="text-align:right"><a href="<?php echo $this->baseUrl("Instructor/RemoveTA/{$class->classid}") ?>"> Remove </a></button>
								 <?php } 
								 
					 }
			?> </h2>
		<!-- Student Information -->
		<h2> <b> Student Information: </b> </h2>
		<?php $studentids = studentClasses::find("classId =:0:", $class->classid); ?>
		<?php if(isset($_SESSION['add_student_errors'])) {
				if(!empty($_SESSION['add_student_errors'])) {
					foreach($_SESSION['add_student_errors'] as $error) {
						echo $error."<br>";
					}
				}
				unset($_SESSION['add_student_errors']);
			}
		?>


		<?php $studentids = studentClasses::find("classId =:0:", $class->classid);?>
		<div class="table-responsive">
			<table class="table table-bordered tbl-background">
				<thead>
					<tr>
						<th scope="col"> Student </th>
						<th scope="col"> Email </th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($studentids as $ids) :
						$student = User::findOne("id =:0:", $ids->studentId); ?>
							<tr>
								<td><a href='<?php echo $this->baseUrl("/Student/Profile/{$student->id}") ?>'><?php echo $student->firstName . " " . $student->lastName ?></a></td>
								<td><?php echo $student->email ?></td>
							</tr>
						<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php echo $this->partial('_Partials/FeedbackForm', ['class' => $class]) ?>