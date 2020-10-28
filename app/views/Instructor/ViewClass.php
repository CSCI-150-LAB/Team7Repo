<h1> <?php echo $class->class . " " . $class->getClassTimeString(); ?> </h1>
<h2> <?php echo $class->description; ?> </h2>

<a class="btn btn-secondary float-right" style="color: #ffffff;" href='<?php echo $this->baseUrl("/Instructor/AddStudent/{$class->classid}") ?>'>Add a Student</a><br>


<div class="dropdown">
	<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Feedback
	</button>
	<div class="dropdown-menu">
		<a href="#textfeedback" class="dropdown-item" data-toggle="modal" data-target="#textfeedback">Create a feedback session</a>
		<a href='<?php echo $this->baseUrl("/Feedback/PublishedFeedback/{$class->classid}") ?>' class="dropdown-item">View Sessions</a>
	</div>
</div>

<div class="modal" id="textfeedback">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Create a feedback session</h5>
				<button class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<?php echo $this->partial('_FeedbackForm', ['class' => $class]) ?>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>






<!--End of drop down menu-->




<?php $studentids = studentClasses::find("classId =:0:", $class->classid); ?>
<table class="table table-bordered">
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