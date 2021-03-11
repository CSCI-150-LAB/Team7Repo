<?php
	$this->pageTitle('View Class');
?>

<h1 class="mb-3 p-5 text-white bg-blue"> <?php echo $class->class . " " . $class->getClassTimeString(); ?> </h1>
<h2> <?php echo $class->description; ?> </h2>


<h5> <b>Class TA:</b> 
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
?> </h5>

<div class="dropdown">
	<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Feedback
	</button>
	<div class="dropdown-menu">
		<a href="#feedback-app" class="dropdown-item" data-toggle="modal" data-target="#feedback-app">Create a feedback session</a>
		<a href='<?php echo $this->baseUrl("/Feedback/PublishedFeedback/{$class->classid}") ?>' class="dropdown-item">View Sessions</a>
	</div>
</div>

<!-- Instructor Tools-->
<div>
<h2> <b> Tools </b></h2>
	<div class="row"> 
	<!-- Feedback -->
	<div class="col-sm-3">
		<div class="card bg-light">
			<div class="card-body">
				<h5 class="card-title"> Get Feedback
				<a href="#" class="btn btn-secondary float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-chevron-down"></i></a>
				<div>
					<div class="dropdown-menu">
						<a href="#feedback-app" class="dropdown-item" data-toggle="modal" data-target="#feedback-app">Create a feedback session</a>
						<a href='<?php echo $this->baseUrl("/Feedback/PublishedFeedback/{$class->classid}") ?>' class="dropdown-item">View Sessions</a>
					</div>
				</div>
				</h5>
				<?php echo $this->partial('_FeedbackForm', ['class' => $class]) ?>
			</div>
		</div>
	</div>


<br> </br>
<!-- Student Information -->
<h2> <b> Student Information </b> </h2>
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

<div class="my-3 text-right">
	<div class="dropdown">
		<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Add
		</button>
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