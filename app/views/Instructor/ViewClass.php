<h1> <?php echo $class->class." ".$class->getClassTimeString(); ?> </h1>
<h2> <?php echo $class->description; ?> </h2>

<a class = "btn btn-secondary float-right" style="color: #ffffff;" href ='<?php echo $this->baseUrl("/Instructor/AddStudent/{$class->classid}") ?>'>Add a Student</a><br>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Feedback
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href='<?php echo $this->baseUrl("/Feedback/RatingFeedback/{$class->classid}") ?>'>Create a rating feedback session</a>
    <a class="dropdown-item" href='<?php echo $this->baseUrl("/Feedback/TextFeedback/{$class->classid}") ?>'>Create a text feedback session</a>
    <a class="dropdown-item" href='<?php echo $this->baseUrl("/Feedback/PublishedFeedback/{$class->classid}") ?>'>View feedback sessions</a>
  </div>
</div>


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