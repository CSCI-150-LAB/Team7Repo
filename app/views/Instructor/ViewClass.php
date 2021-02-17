<?php
	$this->pageTitle('View Class');
?>

<h1> <?php echo $class->class . " " . $class->getClassTimeString(); ?> </h1>
<h2> <?php echo $class->description; ?> </h2>




<div class="dropdown">
	<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Feedback
	</button>
	<div class="dropdown-menu">
		<a href="#feedback-app" class="dropdown-item" data-toggle="modal" data-target="#feedback-app">Create a feedback session</a>
		<a href='<?php echo $this->baseUrl("/Feedback/PublishedFeedback/{$class->classid}") ?>' class="dropdown-item">View Sessions</a>
	</div>
</div>

<?php echo $this->partial('_FeedbackForm', ['class' => $class]) ?>






<!--End of drop down menu-->




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
			<a href='<?php echo $this->baseUrl("/Instructor/AddTA/{$class->classid}") ?>' class="dropdown-item">Add TA</a>
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