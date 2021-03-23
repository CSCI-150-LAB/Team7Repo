<?php
	$this->pageTitle('View Class');
?>
<div class="col mb-3 p-5 text-white bg-blue"> 
	<div class = "row">
		<h1>  <?php echo $class->class . ": " . $class->description; ?> </h1>
	</div>
	<div class = "row">
		<h5> Day and Time: <?php echo  $class->getClassTimeString(); ?></h5>
	</div>
</div>

<!--Class Menu-->
<div class="row mb-3">
	<div class = "col-sm-3">
		<!--Action List-->

					<!-- Group Attendance-->
				<ul class="card list-group list-group-flush">
					<li class="list-group-item"> Track Attendance <a href="#" class="btn btn-danger float-right"> <i class="fas fa-chevron-right"></i></a></li>
					<!-- Course Materials -->
					<li class="list-group-item"> Course Materials <a href="#" class="btn btn-danger float-right"> <i class="fas fa-chevron-right"></i></a> </li>
					<!-- Add Student/TA -->
					<li class="list-group-item text-left"> 	
						<!-- Add Student and TA Dropdown -->
						<div class=""> 
							<div class="dropdown"> Add Student/TA 
								<button class="btn btn-danger float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-chevron-down"></i></button> 
								<div class="dropdown-menu"> 
									<a href='<?php echo $this->baseUrl("/Instructor/AddStudent/{$class->classid}") ?>' class="dropdown-item">Add Student</a>
									<a href='<?php echo $this->baseUrl("/Instructor/AddCSVStudents/{$class->classid}") ?>' class="dropdown-item">Add Students by CSV</a>
									<?php
										if ($ta[0]->id == NULL) { ?>
											<a href='<?php echo $this->baseUrl("/Instructor/AddTA/{$class->classid}") ?>' class="dropdown-item">Add TA</a>
									<?php 
										} ?>
								</div>
							</div>
						</div>
					</li>
				</ul>
						<li class="list-group-item"> Get Feedback
							<a href="#" class="btn btn-danger float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-chevron-down"></i></a>
							<div>
								<div class="dropdown-menu">
									<a href="#feedback-app" class="dropdown-item" data-toggle="modal" data-target="#feedback-app">Create a feedback session</a>
									<a href='<?php echo $this->baseUrl("/Feedback/PublishedFeedback/{$class->classid}") ?>' class="dropdown-item">View Sessions</a>
								</div>
							</div>
							<?php echo $this->partial('_FeedbackForm', ['class' => $class]) ?>
						</li>
		
						<!-- Create Quiz -->
						<li class="list-group-item"> Create Quiz <a href="#" class="btn btn-danger float-right"> <i class="fas fa-chevron-right"></i></a> </li>
						<!-- Launch Whiteboard-->
						<li class="list-group-item"> Launch Whiteboard <a href="#" class="btn btn-danger float-right"> <i class="fas fa-chevron-right"></i></a> </li>

						</li>
					</ul>

	</div>
	<div class ="col"> 
		<!-- TA Information -->
		<h2> <b> Teaching Assistant: </b>
		<!-- Table for TA 
			<table class="table table-bordered tbl-background">
				<thead>
					<tr>
						<th scope="col">Student </th>
						<th scope="col"> Email </th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td> </td>
						<td> </td>
					</tr>
				</tbody>
			<table> --> 
			
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
