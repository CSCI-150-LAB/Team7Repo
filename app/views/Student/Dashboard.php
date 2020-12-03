<?php
	/** @var User $user */
	/** @var InstructorClasses[] $classes */
	$this->pageTitle('Dashboard');
?>

<div class="mb-3 bg-blue text-white p-5">
	<h1 class="mb-0">Student Dashboard</h1>
</div>

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
			<?php foreach ($classes as $classDetails) : ?>
				<tr>
					<th scope="row"> <a href = '<?php echo $this->baseUrl("/Feedback/PublishedFeedback/{$classDetails->classid}")?>'><?php echo $classDetails->class ?></a> </th>
					<!--Display the title of the class-->
					<td> <?php echo $classDetails->description ?> </td>
					<!--Display the description of the class-->
					<td> <?php echo $classDetails->getClassTimeString()?> </td>
					<!--Display the time the class runs for-->
					<td> <a href = '<?php echo $this->baseUrl("/Instructor/Profile/{$classDetails->instructorid}") ?>'><?php echo $classDetails->getInstructor()->getFullName(true) ?></a> </td>
					<!--Display instructor name and link to their profile page-->	
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>