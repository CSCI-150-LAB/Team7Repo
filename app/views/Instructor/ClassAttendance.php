<?php  $this->papgeTitle("ClassAttendance");?>

<div class="container">

<h1 class="mb-3 p-5 text-white bg-blue"> <?php echo $class->class?> Attendance </h1>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="track-tab" data-toggle="tab" href="#track" role="tab" aria-controls="tack" aria-selected="true">Track Attendance</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="false">Overview</a>
  </li>
</ul>
<div class="tab-content tbl-background" id="myTabContent">
  <div class="tab-pane fade show active" id="Track" role="tabpanel" aria-labelledby="track-tab">
  <form method="post" action=""> <!-- form for  class selection-->
                <div class="row">
                    
                        <form method="post" action =""> <!-- form for week selecttion--> 
                            <label for="week-start">Choose Date:</label>
                            <input type="date" id="start" name="week-start"value="2021-01-01"min="2021-01-01" max="2021-12-31">
                        </form>

                       

                </div>
            </form>
 
    <?php $studentids = studentClasses::find("classId =:0:", $class->classid);?>
    <div class="table-responsive">
        <table class="table table-bordered tbl-background">
            <thead> 
                <tr> 
                    <th scope="col"> Student Name </th>
                    <th scope="col"> Present </th>
                    <th scope="col"> Absent </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($studentids as $ids) :
                $student = User::findOne("id =:0:", $ids->studentId); ?>
                <tr>
                    <td><a href='<?php echo $this->baseUrl("/Student/Profile/{$student->id}") ?>'><?php echo $student->firstName . " " . $student->lastName ?></a></td>
                    <td> <input type="radio" id="Present" name="Attendance" value="Present"> <label for="Present"></label></td>
                    <td> <input type="radio" id="Absent" name="Attendance" value="Absent"> <label for="Absent"></label></td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>

        <input class="btn btn-danger text-white" type="submit" value="Save"> 
    </div>
  <div class="tab-pane fade" id="overview" role="tabpanel" aria-labelledby="overview-tab">
    <div class="table-responsive">
        <table class="table table-bordered tbl-background">
            <thead> 
                <tr> 
                    <th scope="col"> Student Name </th>
                    <th scope="col"> Missed Days </th>
                    <th scope="col"> Total Days Tracked </th>
                    <th scope="col"> Overall Percentage </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($studentids as $ids) :
                $student = User::findOne("id =:0:", $ids->studentId); ?>
                <tr>
                    <td><a href='<?php echo $this->baseUrl("/Student/Profile/{$student->id}") ?>'><?php echo $student->firstName . " " . $student->lastName ?></a></td>
                    <td> something</td>
                    <td> something</td>
                    <td> something</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
  </div>
</div>

</div>


