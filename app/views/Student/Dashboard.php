<?php 
    $user = User::getCurrentUser();																			// Get the current user information
?>

<h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">
	Student Dashboard</h1>

<h2 style="padding-left:60px; padding-top:25px;"> Enrolled Classes </h2> <br>


<?php $classes = studentClasses::find("student_id = :0:", $user->id); ?>									<!--Find all classes associated with the student ID of the current user-->

<table class="table table-bordered">																		<!--Lay out the table to hold info on enrolled classes-->
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

                    <tr>
		            <th scope="row"> <?php echo $details[$i]->class ?> </th>
		            <td> <?php echo $details[$i]->description ?> </td>
		            <td> <?php echo $details[$i]->getClassTimeString()?> </td>
		            <td> <a href = '<?php echo $this->baseUrl("/Instructor/Profile/{$details[$i]->instructorid}") ?>'><?php echo $instructors[$i]->name . " " . $instructorsNames[$i]->firstName . " " . $instructorsNames[$i]->lastName ?></a> </td>
		            </tr>

                <?php
                }
        ?>
	</tbody>
</table>