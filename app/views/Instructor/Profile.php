<?php
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
            <h4 class="card-title" style="text-align: center">Teaching Styles</h4><br>
            <b>Visual:</b> <?php echo $profile->visual ?> <br>
            <b>Auditory:</b> <?php echo $profile->auditory ?> <br>
            <b>Reading/Writing:</b> <?php echo $profile->readwrite ?> <br>
            <b>Kinesthetic:</b> <?php echo $profile->kines ?> <br>
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
                    if($review->rating > $topreview) {
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