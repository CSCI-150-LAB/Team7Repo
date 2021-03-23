<?php
	/** @var User $user */
	/** @var InstructorClasses[] $classes */
	$this->pageTitle('Dashboard');
?>

<div class="mb-3 bg-blue text-white p-5 dashboardheader">
	<h1 class="mb-0">Student Dashboard</h1>
</div>

<button class = 'btn btn-secondary float-md-right text-white' data-start-tour="Student Dashboard Tour">Help</button><br><br> 

<div class="table-responsive classesenrolled">
	<h3 class="mb-0"><b>Enrolled Classes</b></h3>
	<br>
	<table class="table table-bordered tbl-background">																		<!--Lay out the table to hold info on enrolled classes-->
		<thead>
			<tr>
			<th scope="col" class = "classname"> Class </th>
			<th scope="col" class = "classdescription"> Description </th>
			<th scope="col" class = "classtime"> Days/Times</th>
			<th scope="col" class = "classinstructor"> Instructor</th>
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

<?php 
	$taClass = InstructorClasses::find("ta_id =:0:", $user->id);
	if ($taClass[0] != NULL) { ?>
		<div><h3 class="mb-0"><b>TA Classes</b></h3></div>
		<br>
		<table class="table table-bordered tbl-background taclasses">																		<!--Lay out the table to hold info on enrolled classes-->
			<thead>
				<tr>
				<th scope="col"> Class </th>
				<th scope="col"> Description </th>
				<th scope="col"> Days/Times</th>
				<th scope="col"> Instructor</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($taClass as $classDetails) : ?>
					<tr>
						<th scope="row"> <a href = '<?php echo $this->baseUrl("/Instructor/ViewClass/{$classDetails->classid}")?>'><?php echo $classDetails->class ?></a> </th>
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

	<?php
		
	}
?>