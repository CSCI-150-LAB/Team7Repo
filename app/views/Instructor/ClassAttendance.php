<?php  $this->papgeTitle("CourseMaterials");?>

<div class="container">

<h1 class="mb-3 p-5 text-white bg-blue"> Attendance </h1>

<?php $classes = InstructorClasses::find("instructorid =:0:", $user->id); ?>

<form method="post" action="">
    <div class="row">
        <div class="col-sm">
                <label for="course">Choose Class:</label>
                <select name="course" id="class" data-live-search="true" class="mdb-select md-form colorful-select dropdown-primary">
                    <?php  foreach($classes as $class):?>
                        <option value="<?php echo $class->classid ?>"> <?php echo $class->class ?> </option>
                    <?php endforeach;?>
                </select>
        </div>
        <div class="col-sm">
            <label for="">Choose Date:</label>
            <input type="date" id="start" name="trip-start"
                value="2020-01-01"
                min="2021-01-01" max="2021-12-31">
        </div>
        <div class="col-sm">
            <input class="btn btn-secondary text-white" type="submit" value="Go"> 
        </div>
    </div>
</form>


<div id="course">
    <?php
        if(isset($_POST))    // checks whether any value is posted
        {
          $c_id = $_POST['course'];
        }
    ?>
</div>

<?php $studentids = studentClasses::find("classId =:0:", $c_id);?>
    <div class="table-responsive">
        <table class="table table-bordered tbl-background">
            <thead> 
                <tr> 
                    <th scope="col"> Student Name <i class="fas fa-sort-down"></th>
                    <th scope="col"> Date </th>
                    <th scope="col"> Date </th>
                    <th scope="col"> Date </th>
                    <th scope="col"> Date </th>
                    <th scope="col"> Date </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($studentids as $ids) :
                    $student = User::findOne("id =:0:", $ids->studentId); ?>
                    <tr>
                        <td><?php echo $student->firstName . " " . $student->lastName ?></td>
                        <td> <input type="radio" id="Present" name="Attendance" value="Present"> <label for="Present">1</label> <input type="radio" id="Absent" name="Attendance" value="Absent"> <label for="Absent">0</label></td>
                        <td> <input type="radio" id="Present" name="Attendance" value="Present"> <label for="Present">1</label> <input type="radio" id="Absent" name="Attendance" value="Absent"> <label for="Absent">0</label></td>
                        <td> <input type="radio" id="Present" name="Attendance" value="Present"> <label for="Present">1</label> <input type="radio" id="Absent" name="Attendance" value="Absent"> <label for="Absent">0</label></td>
                        <td> <input type="radio" id="Present" name="Attendance" value="Present"> <label for="Present">1</label> <input type="radio" id="Absent" name="Attendance" value="Absent"> <label for="Absent">0</label></td>
                        <td> <input type="radio" id="Present" name="Attendance" value="Present"> <label for="Present">1</label> <input type="radio" id="Absent" name="Attendance" value="Absent"> <label for="Absent">0</label></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <button type="button" class="btn btn-danger text-white" > Save </button>
</div>