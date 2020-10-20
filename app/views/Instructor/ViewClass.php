<h1> <?php echo $class->class." ".$class->getClassTimeString(); ?> </h1>
<h2> <?php echo $class->description; ?> </h2>
<a class = "btn btn-secondary float-right" style="color: #ffffff;" href ='<?php echo $this->baseUrl("/Instructor/AddStudent/{$class->classid}") ?>'>Add a Student</a><br>
<a class = "btn btn-secondary" style="color: #ffffff;" href ='<?php echo $this->baseUrl("/Feedback/InitiateFeedback") ?>'>Create feedback session</a><br>
<?php $studentids = studentClasses::find("classId =:0:", $class->classid);?>
<table class="table table-bordered">
	<thead>
		<tr>
		    <th scope="col"> Student </th>
		    <th scope="col"> Email </th>
		</tr>
	</thead>
	<tbody>
        <?php   $students = [];
                foreach($studentids as $ids):
                    $students = User::find("id =:0:", $ids->studentId);
                    foreach($students as $student):?>
                        <tr>
                            <td><a href = '<?php echo $this->baseUrl("/Student/Profile/{$student->id}") ?>'><?php echo $student->firstName." ".$student->lastName ?></a></td>
                            <td><?php echo $student->email ?></td><?php
                    endforeach;?>
                        </tr>
                <?php endforeach; ?>
    </tbody>
</table>