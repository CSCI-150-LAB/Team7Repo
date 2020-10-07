<h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">
	Instructor Dashboard</h1>

<h2 style="padding-left:60px; padding-top:25px;"> Classroom Sections </h2> <br>

<div class="border border-dark mb-3" style="padding-right: 60px; padding-top:28px">
	<h4 style="padding-left:60px;;">
		Add a new classroom section
		<a class = "btn btn-secondary float-right" style="color: #ffffff;" href ='<?php echo $this->baseUrl('/Instructor/AddClass') ?>'>Create a Section</a>
	</h4>
</div>
<?php $classes = InstructorClasses::find("instructorid =:0:", $user->id); ?>
<table class="table table-bordered">
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
                <td><?php echo $class->class ?></td>
                <td><?php echo $class->description ?></td>
                <td><?php echo $class->getClassTimeString() ?></td>
                <td></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>