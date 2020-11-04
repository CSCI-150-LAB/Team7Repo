<?php
$currentUser = User::getCurrentUser();
$profile = InstructorModel::getByKey($user->id); ?>
<h1 class='mb-3' style= 'background-color: #13284c; padding:60px; color: #ffffff;'>Instructor Profile</h1>
<?php   if($profile->instructorid == $currentUser->id) {
            echo "<a class = 'btn btn-secondary float-right' style='color: #ffffff;' href = '".$this->baseUrl("/Instructor/EditProfile/{$currentUser->id}")."'>Edit Profile</a>";
        } //Allows user to edit profile if current profile is the user's profile ?>
<div style="display: flex; align-items: center;">
<img src="<?php echo $this->publicUrl('images/blank_avatar.png')?>" width="250px" alt="blank_avatar"><div><h2>
<?php   if($profile->name != NULL) {
            echo $profile->name." ";
        }
        echo $user->firstName." ".$user->lastName."</h2><br>"; ?>   <!--Makes heading of professor's profile, with title if chosen-->
        <h3><?php echo $profile->department.'<br>';
        echo $user->email.'</h3></div></div><br>'; ?>
<div class="card-columns" style="column-count: 2;">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title" style="text-align: center">Teaching Styles</h4><br>
            Visual: <?php echo $profile->visual ?> <br>
            Auditory: <?php echo $profile->auditory ?> <br>
            Reading/Writing: <?php echo $profile->readwrite ?> <br>
            Kinesthetic: <?php echo $profile->kines ?> <br>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title" style="text-align: center">Top Review</h5>
            <?php $reviews = InstructorRatings::find("instructor_id = :0:", $profile->instructorid); 
            ?>
        </div>
    </div>
    <div class="card p-3">
        <div class="card-body">
            <h5 class="card-title" style="text-align: center">Recent Feedback</h5>
            <?php $recent = count($reviews)-2;
            for($i=0; $i<5; $i++) {
                if($reviews[$recent]->rating > $i) {
                    echo 'X';
                }
                else {
                    echo 'O';
                }
            }
            echo '<br>';
            if ($reviews[$recent]->takeAgain) {
                echo 'Would take again: '.$reviews[$recent]->takeAgain.' ';
            }
            if ($reviews[$recent]->homework) {
                echo 'Homework: '.$reviews[$recent]->homework.' ';
            }
            if ($reviews[$recent]->attendanceRequired) {
                echo 'Attendance required: '.$reviews[$recent]->attendanceRequired.' ';
            }
            if ($reviews[$recent]->grade) {
                echo 'Grade: '.$reviews[$recent]->grade;
            }
            echo '<br>'.$reviews[$recent]->recommendation.'<br>-';
            if ($reviews[$recent]->authorId == 0) {
                echo "Anonymous ";
            }
            else {
                $student = User::find("id = :0:", $reviews[$recent]->authorId);
                echo $student[0]->firstName.' '.$student[0]->lastName.' ';
            }
            if($reviews[$recent]->verified) {
                echo 'verified';
            }
            echo '<br><br>';

            $recent = $recent + 1;
            for($i=0; $i<5; $i++) {
                if($reviews[$recent]->rating > $i) {
                    echo 'X';
                }
                else {
                    echo 'O';
                }
            }
            echo '<br>';
            if ($reviews[$recent]->takeAgain) {
                echo 'Would take again: '.$reviews[$recent]->takeAgain.' ';
            }
            if ($reviews[$recent]->homework) {
                echo 'Homework: '.$reviews[$recent]->homework.' ';
            }
            if ($reviews[$recent]->attendanceRequired) {
                echo 'Attendance required: '.$reviews[$recent]->attendanceRequired.' ';
            }
            if ($reviews[$recent]->grade) {
                echo 'Grade: '.$reviews[$recent]->grade;
            }
            echo '<br>'.$reviews[$recent]->recommendation.'<br>-';
            if ($reviews[$recent]->authorId == 0) {
                echo "Anonymous ";
            }
            else {
                $student = User::find("id = :0:", $reviews[$recent]->authorId);
                echo $student[0]->firstName.' '.$student[0]->lastName.' ';
            }
            if($reviews[$recent]->verified == 1) {
                echo 'verified';
            }
            echo '<br><br>'; ?>
            <a href = '<?php echo $this->baseUrl("/Instructor/ViewReviews/{$profile->instructorid}") ?>' class = 'card-link'>See all reviews >></a>
        </div>
    </div>
</div>