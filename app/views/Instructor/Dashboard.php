<h1 class="mb-3" style="background-image: url('images/mainbanner2.png'); width:100%; padding:60px; z-index:-1; color: #ffffff ">
	Instructor Dashboard</h1>

<h2 style="padding-left:60px"> Classroom Sections </h2> <br>

<div class="border border-dark mb-3">
	<h4 style="padding-left:60px">
		Add a new classroom section
		<a class = "btn btn-secondary float-right" href = '<?php echo $this->baseUrl('/Instructor/AddClass') ?>'>Create a Section</a>
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