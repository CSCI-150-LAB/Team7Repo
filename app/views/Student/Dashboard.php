<?php 
	$user = User::getCurrentUser();																			// Get the current user information
	$this->pageTitle('Dashboard');
?>

<div class="mb-3 bg-blue text-white p-5">
	<h1 class="mb-0">Student Dashboard</h1>
</div>

<?php $classes = studentClasses::find("student_id = :0:", $user->id); ?>									<!--Find all classes associated with the student ID of the current user-->

<div class="table-responsive">
	<table class="table table-bordered tbl-background">																		<!--Lay out the table to hold info on enrolled classes-->
		<thead>
			<tr>
			<th scope="col"> Class </th>
			<th scope="col"> Description </th>
			<th scope="col"> Days/Times</th>
			<th scope="col"> Instructor</th>
			</tr>
		</thead>
		<tbody>
			<?php  
			$i = 0;  																							// Index variable
			foreach ($classes as $value) {																		// For each class the student is enrolled in
	
						$details = InstructorClasses::find("classid = :0:", $value->classId);					// Get the instructor associated with the classes, all stored in array
	
						$instructors = InstructorModel::find("instructorid = :0:", $details[$i]->instructorid); // Get a single instructor and info associated with the profile
						$instructorsNames = User::find("id = :0:", $instructors[$i]->instructorid);				// Get the specific instructor profile details associated with the instructor
						?>
	
						
						<th scope="row"> <a href = '<?php echo $this->baseUrl("/Feedback/PublishedFeedback/{$details[$i]->classid}")?>'><?php echo $details[$i]->class ?></a> </th>
						<!--Display the title of the class-->
						<td> <?php echo $details[$i]->description ?> </td>
						<!--Display the description of the class-->
						<td> <?php echo $details[$i]->getClassTimeString()?> </td>
						<!--Display the time the class runs for-->
						<td> <a href = '<?php echo $this->baseUrl("/Instructor/Profile/{$details[$i]->instructorid}") ?>'><?php echo $instructors[$i]->name . " " . $instructorsNames[$i]->firstName . " " . $instructorsNames[$i]->lastName ?></a> </td>
						<!--Display instructor name and link to their profile page-->	
					</tr>
	
					<?php
					}
			?>
		</tbody>
	</table>
</div>