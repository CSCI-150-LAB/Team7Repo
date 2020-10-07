<?php 
    $user = User::getCurrentUser();
?>

<h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">
	Student Dashboard</h1>

<h2 style="padding-left:60px; padding-top:25px;"> Enrolled Classes </h2> <br>


<?php $classes = studentClasses::find("student_id = :0:", $user->id); ?>

<table class="table table-bordered">
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
        $i = 0;  
        foreach ($classes as $value) {

                    $details = InstructorClasses::find("classid = :0:", $value->classId);

                    $instructors = InstructorModel::find("instructorid = :0:", $details[$i]->instructorid);
                    $instructorsNames = User::find("id = :0:", $instructors[$i]->instructorid);
                    ?>

                    <tr>
		            <th scope="row"> <?php echo $details[$i]->class ?> </th>
		            <td> <?php echo $details[$i]->description ?> </td>
		            <td> <?php echo $details[$i]->getClassTimeString()?> </td>
		            <td> <?php echo $instructors[$i]->name . " " . $instructorsNames[$i]->firstName . " " . $instructorsNames[$i]->lastName ?> </td>
		            </tr>

                <?php
                }
        ?>
	</tbody>
</table>