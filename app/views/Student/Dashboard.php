<?php 
    $user = User::getCurrentUser();
?>

<h1 class="mb-3" style="background-image: url('images/mainbanner2.png'); width:100%; padding:60px; z-index:-1; color: #002e7d ">
	Student Dashboard</h1>

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