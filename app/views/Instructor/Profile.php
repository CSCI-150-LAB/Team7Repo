<?php
$this->scriptEnqueue('chart-js', 'https://cdn.jsdelivr.net/npm/chart.js@2.8.0');
$currentUser = User::getCurrentUser();
$profile = InstructorModel::getByKey($user->id); ?>
<h1 class='mb-3' style= 'background-color: #13284c; padding:60px; color: #ffffff;'>Instructor Profile</h1>
<?php   if($profile->instructorid == $currentUser->id) {
            echo "<a class = 'btn btn-secondary float-right' style='color: #ffffff;' href = '".$this->baseUrl("/Instructor/EditProfile/{$currentUser->id}")."'>Edit Profile</a><br><br>";
        } //Allows user to edit profile if current profile is the user's profile ?>
<h4 style='float: right;'>
<?php echo PrintHelpers::printStarRating($profile->rating) ?>
</h4>
<div style="display: flex; align-items: center;">
<img src="<?php echo $this->publicUrl('images/blank_avatar.png')?>" width="250px" alt="blank_avatar" class="mr-4"><div><h2>
<?php   if($profile->name != NULL) {
            echo $profile->name." ";
        }
        echo $user->firstName." ".$user->lastName."</h2><br>"; ?>   <!--Makes heading of professor's profile, with title if chosen-->
        <h3><?php echo $profile->department.'<br>';
        echo $user->email.'</h3></div></div><br>'; ?>
<div class="card-columns" style="column-count: 2;">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title" style="text-align: center">Teaching Styles</h4>
            <b>Visual:</b> <?php echo $profile->visual ?> <br>
            <b>Auditory:</b> <?php echo $profile->auditory ?> <br>
            <b>Reading/Writing:</b> <?php echo $profile->readwrite ?> <br>
            <b>Kinesthetic:</b> <?php echo $profile->kines ?> <br><br>
            <?php
            $ratings = InstructorRatings::find("instructor_id = :0:", $user->id);
            if($ratings) {
                $numTotalTA = 0;
                $numTA = 0;
                $numTotalGrades = 0;
                $A = 0;
                $B = 0;
                $C = 0;
                $D = 0;
                $F = 0;
                foreach($ratings as $rating) {
                    if($rating->grade != "N/A") {
                        $numTotalGrades += 1;
                        if($rating->grade == 'A') {
                            $A += 1;
                        }
                        elseif($rating->grade == 'B') {
                            $B += 1;
                        }
                        elseif($rating->grade == 'C') {
                            $C += 1;
                        }
                        elseif($rating->grade == 'D') {
                            $D += 1;
                        }
                        elseif($rating->grade == 'F') {
                            $F += 1;
                        }
                    }
                    if($rating->takeAgain != "N/A") {
                        $numTotalTA += 1;
                        if($rating->takeAgain == 'Yes') {
                            $numTA += 1;
                        }
                    }
                }
                $percentTA = ($numTA/$numTotalTA)*100;
                $arr = [$A, $B, $C, $D, $F];
                if($numTotalTA) {?>
                <h4 class="card-title" style="text-align: center">Students would take again</h4>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow=<?php echo $percentTA ?> aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentTA ?>%">
                        <?php echo $percentTA ?>%
                    </div>
                </div>
                <p style="text-align: center">Out of <?php echo $numTotalTA?> people who answered</p>
                <?php }
                if($numTotalGrades) { ?>
                <h4 class="card-title" style="text-align: center">Student grades</h4>
                <p style="text-align: center">Out of <?php echo $numTotalGrades?> people who answered</p>
                <canvas id="myChart"></canvas>
                <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var data = [<?php echo join(',',$arr); ?>];
                    var myPieChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                        datasets: [{
                            backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                            data: <?php echo json_encode($arr, JSON_NUMERIC_CHECK); ?>
                        }],
                        labels: [
                            'A',
                            'B',
                            'C',
                            'D',
                            'F'
                        ]
                    }
                    });
                </script>
            <?php } } ?>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title" style="text-align: center">Top Review</h4>
            <?php $reviews = InstructorRatings::find("instructor_id = :0: AND verified = :1:", $user->id, 1);
            if(!$reviews) {
                $reviews = InstructorRatings::find("instructor_id = :0:", $user->id);
            }
            if($reviews) {
                $topreview = $reviews[0];
                foreach($reviews as $review)  {
                    if($review->rating > $topreview->rating) {
                        $topreview = $review;
                    }
                }
                if($topreview) {
                    echo $topreview->printRating();
                }
            }
            else {
                echo "No recommendations yet";
                $currentUser = User::getCurrentUser();
                $isStud = User::find("id = :0:", $currentUser->id);
                if ($isStud[0]->type == 'student') {
                    echo ", be the first! <a  href = '".$this->baseUrl("/Student/AddReview/{$user->id}")."'>Add Review >></a><br>";
                }
            }
            ?>
        </div>
    </div>
    <div class="card p-3">
        <div class="card-body">
            <h4 class="card-title" style="text-align: center">Recent Feedback</h4>
            <?php $reviews = InstructorRatings::find("instructor_id = :0:", $user->id);
            $recent = count($reviews)-1;
            if($recent >= 0) {
                echo $reviews[$recent]->printRating();
                echo '<br><br>';
            }
            else {
                echo "No recommendations yet";
                $currentUser = User::getCurrentUser();
                $isStud = User::find("id = :0:", $currentUser->id);
                if ($isStud[0]->type == 'student') {
                    echo ", be the first! <a  href = '".$this->baseUrl("/Student/AddReview/{$user->id}")."'>Add Review >></a><br>";
                }
            }
            $recent -= 1;
            if($recent >= 0) {
                echo $reviews[$recent]->printRating();
                echo '<br><br>';
            }
            if($reviews) { ?>
                <a href = '<?php echo $this->baseUrl("/Instructor/ViewReviews/{$user->id}") ?>' class = 'card-link'>See all reviews >></a>
            <?php } ?>
        </div>
    </div>
</div>