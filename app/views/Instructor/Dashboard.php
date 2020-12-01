<h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">
	Instructor Dashboard</h1>

<div class="table-bordered mb-3 tbl-background" style="padding-right: 60px; padding-top:28px">
	<h4 style="padding-left:60px;">
		Add a new classroom section
		<a class = "btn btn-secondary float-right" style="color: #ffffff;" href ='<?php echo $this->baseUrl('/Instructor/AddClass') ?>'>Create a Section</a>
	</h4>
</div>
<?php $classes = InstructorClasses::find("instructorid =:0:", $user->id); ?>
<table class="table table-bordered tbl-background">
	<thead>
		<tr>
			<th scope="col"> Class </th>
			<th scope="col"> Description </th>
			<th scope="col"> Days/Times</th>
			<th scope="col"> Student Enrollment</th>
		</tr>
	</thead>
	<tbody>
        <?php foreach($classes as $class):?>
            <tr>
                <td><a href = '<?php echo $this->baseUrl("/Instructor/ViewClass/{$class->classid}") ?>'><?php echo $class->class ?></a></td>
                <td><?php echo $class->description ?></td>
                <td><?php echo $class->getClassTimeString() ?></td>
                <td><?php $students = studentClasses::find("classId =:0:", $class->classid); echo count($students) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>