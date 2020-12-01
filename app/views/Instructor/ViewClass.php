<?php
	// Load extra assets for the feedback form code
	$this->scriptEnqueue('vuejs', 'https://cdn.jsdelivr.net/npm/vue@2.6.12');
?>

<h1> <?php echo $class->class . " " . $class->getClassTimeString(); ?> </h1>
<h2> <?php echo $class->description; ?> </h2>




<div class="dropdown">
	<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Feedback
	</button>
	<div class="dropdown-menu">
		<a href="#textfeedback" class="dropdown-item" data-toggle="modal" data-target="#textfeedback">Create a feedback session</a>
		<a href='<?php echo $this->baseUrl("/Feedback/PublishedFeedback/{$class->classid}") ?>' class="dropdown-item">View Sessions</a>
	</div>
</div>

<div class="modal fade" id="textfeedback">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo $class->class ?>: Create a feedback session</h5>
				<button class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<?php echo $this->partial('_FeedbackForm', ['class' => $class]) ?>
			</div>
		</div>
	</div>
</div>






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
<a class = "btn btn-secondary float-right" style="color: #ffffff;" href ='<?php echo $this->baseUrl("/Instructor/AddStudent/{$class->classid}") ?>'>Add a Student</a><br><br>
<a class = "btn btn-secondary float-right" style="color: #ffffff;" href ='<?php echo $this->baseUrl("/Instructor/AddCSVStudents/{$class->classid}") ?>'>Add Students by CSV</a><br>
<?php $studentids = studentClasses::find("classId =:0:", $class->classid);?>
<table class="table table-bordered tbl-background">
	<thead>
		<tr>
			<th scope="col"> Student </th>
			<th scope="col"> Email </th>
		</tr>
	</thead>
	<tbody>
		<?php $students = [];
		foreach ($studentids as $ids) :
			$students = User::find("id =:0:", $ids->studentId);
			foreach ($students as $student) : ?>
				<tr>
					<td><a href='<?php echo $this->baseUrl("/Student/Profile/{$student->id}") ?>'><?php echo $student->firstName . " " . $student->lastName ?></a></td>
					<td><?php echo $student->email ?></td><?php
														endforeach; ?>
				</tr>
			<?php endforeach; ?>
	</tbody>
</table>