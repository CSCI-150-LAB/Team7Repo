<?php
    $currentUser = User::getCurrentUser();
	$this->pageTitle("Dashboard");
?>

<h1 class="mb-3 p-5 text-white bg-blue">Help Page: view tutorials for FeedbackLoop here</h1><br><br>

<h2>General Tours:</h2>

<div class="row">
    <div class="col-sm-6 col-lg-3 my-3">
        <?php if($currentUser->type == "instructor"): ?>
            <a data-reset-tour='Instructor View Reviews Tour' href = '<?php echo($this->baseUrl("/Instructor/ViewReviews/{$currentUser->id}")) ?>'>
                <div class="card">
                    <img class="card-img-top" src="<?php echo $this->publicUrl('images/InstructorReviews-InstructorView.PNG')?>">
                    <div class="card-body">
                        <h5 class="card-title text-center">View Instructor Reviews</h5>
                        <p class="card-text">Learn how to navigate your reviews page.</p>
                    </div>
                </div>
            </a><br><br>
        <?php else: ?>
            <a data-reset-tour='Instructor View Reviews Tour' href = '<?php echo($this->baseUrl("/Instructor/ViewReviews/1443")) ?>'>
                <div class="card">
                    <img class="card-img-top" src="<?php echo $this->publicUrl('images/InstructorReviews-StudentView.PNG')?>">
                    <div class="card-body">
                        <h5 class="card-title text-center">View Instructor Reviews</h5>
                        <p class="card-text">Learn how to navigate an instructor's review page.</p>
                    </div>
                </div>
            </a>
        <?php endif; ?>
    </div>
</div>

<?php if($currentUser->type == "instructor" || $currentUser->type == "admin"): ?>
    <h2>Instructor Tours:</h2>

    <div class="row">
        <div class="col-sm-6 col-lg-3 my-3">
            <a data-reset-tour='Add Class Tour' href = '<?php echo($this->baseUrl("/Instructor/AddClass")) ?>'>
                <div class="card">
                    <img class="card-img-top" src="<?php echo $this->publicUrl('images/AddClass.PNG')?>">
                    <div class="card-body">
                        <h5 class="card-title text-center">Add Class</h5>
                        <p class="card-text">Learn how to add a new class you are instructor of.</p>
                    </div>
                </div>
            </a>
        </div>
    
        <?php
            $class = InstructorClasses::findOne("instructorid =:0:", $currentUser->id);
            if($class): ?>
                <div class="col-sm-6 col-lg-3 my-3">
                    <a data-reset-tour='FeedbackForm Tour' href = '<?php echo($this->baseUrl("/Instructor/ViewClass/{$class->classid}/#feedback-form")) ?>'>
                        <div class="card">
                            <img class="card-img-top" src="<?php echo $this->publicUrl('images/FeedbackForm.PNG')?>">
                            <div class="card-body">
                                <h5 class="card-title text-center">FeedbackForm</h5>
                                <p class="card-text">Learn how to add a new feedback session for one of your classes.</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-sm-6 col-lg-3 my-3">
                    <a data-reset-tour='Instructor View Class Tour' href = '<?php echo($this->baseUrl("/Instructor/ViewClass/{$class->classid}")) ?>'>
                        <div class="card">
                            <img class="card-img-top" src="<?php echo $this->publicUrl('images/ViewClass.PNG')?>">
                            <div class="card-body">
                                <h5 class="card-title text-center">View Class</h5>
                                <p class="card-text">Learn about the view class page and the instructor tools on the page.</p>
                            </div>
                        </div>
                    </a>
                </div>
            
            <?php else: ?>
                <div class="col-sm-6 col-lg-3 my-3">
                    <a data-reset-tour='FeedbackForm Tour' href = '<?php echo($this->baseUrl("/Instructor/ViewClass/3/#feedback-form")) ?>'>
                        <div class="card">
                            <img class="card-img-top" src="<?php echo $this->publicUrl('images/FeedbackForm.PNG')?>">
                            <div class="card-body">
                                <h5 class="card-title text-center">FeedbackForm</h5>
                                <p class="card-text">Learn how to add a new feedback session for one of your classes.</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-sm-6 col-lg-3 my-3">
                    <a data-reset-tour='Instructor View Class Tour' href = '<?php echo($this->baseUrl("/Instructor/ViewClass/3")) ?>'>
                        <div class="card">
                            <img class="card-img-top" src="<?php echo $this->publicUrl('images/ViewClass.PNG')?>">
                            <div class="card-body">
                                <h5 class="card-title text-center">View Class</h5>
                                <p class="card-text">Learn about the view class page and the instructor tools on the page.</p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
    </div>
<?php endif; ?>

<h2>Profile and Dashboard Tours:</h2>

<div class="row">
    <div class="col-sm-6 col-lg-3 my-3">
        <?php if($currentUser->type == "student"): ?>
            <a data-reset-tour='Student Dashboard Tour' href = '<?php echo($this->baseUrl("/Student/Dashboard")) ?>'>
                <div class="card">
                    <img class="card-img-top" src="<?php echo $this->publicUrl('images/StudentDashboard.PNG')?>">
                    <div class="card-body">
                        <h5 class="card-title text-center">Student Dashboard</h5>
                        <p class="card-text">Learn how to navigate your student dashboard.</p>
                    </div>
                </div>
            </a>
        <?php elseif($currentUser->type == "instructor"): ?>
            <a data-reset-tour='Instructor Dashboard Tour' href = '<?php echo($this->baseUrl("/Instructor/Dashboard")) ?>'>
                <div class="card">
                    <img class="card-img-top" src="<?php echo $this->publicUrl('images/InstructorDashboard.PNG')?>">
                    <div class="card-body">
                        <h5 class="card-title text-center">Instructor Dashboard</h5>
                        <p class="card-text">Learn how to navigate your instructor dashboard.</p>
                    </div>
                </div>
            </a>
        <?php elseif($currentUser->type == "admin"): ?>
            <a data-reset-tour='Admin Panel Tour' href = '<?php echo($this->baseUrl("/Admin/Panel/{$currentUser->id}")) ?>'>
                <div class="card">
                    <img class="card-img-top" src="<?php echo $this->publicUrl('images/AdminPanel.PNG')?>">
                    <div class="card-body">
                        <h5 class="card-title text-center">Admin Panel</h5>
                        <p class="card-text">Learn how to navigate your admin panel page.</p>
                    </div>
                </div>
            </a>
            </div>
            <div class="col-sm-6 col-lg-3 my-3">
            <a data-reset-tour='Admin Start Feedback Tour' href = '<?php echo($this->baseUrl("/Admin/StartSession")) ?>'>
                <div class="card">
                    <img class="card-img-top" src="<?php echo $this->publicUrl('images/AdminFeedbackSessions.PNG')?>">
                    <div class="card-body">
                        <h5 class="card-title text-center">Admin Feedback Sessions</h5>
                        <p class="card-text">Learn how to navigate your feedback session tool and start feedback sessions for classes.</p>
                    </div>
                </div>
            </a>
        <?php else: ?>
            <a href = '<?php echo($this->baseUrl("/User/Login")) ?>'>
                <div class="card">
                    <img class="card-img-top" src="<?php echo $this->publicUrl('images/Login-Register.PNG')?>">
                    <div class="card-body">
                        <h5 class="card-title text-center">Sign In/Register</h5>
                        <p class="card-text">Sign in or create a new account and start using FeedbackLoop!</p>
                    </div>
                </div>
            </a>
        <?php endif; ?>
    </div>

    <div class="col-sm-6 col-lg-3 my-3">
        <?php if($currentUser->type == "instructor"): ?>
            <a data-reset-tour='Instructor Tour' href = '<?php echo($this->baseUrl("/Instructor/Profile/{$currentUser->id}")) ?>'>
                <div class="card">
                    <img class="card-img-top" src="<?php echo $this->publicUrl('images/InstructorProfile-InstructorView.PNG')?>">
                    <div class="card-body">
                        <h5 class="card-title text-center">Instructor Profile</h5>
                        <p class="card-text">Learn how to navigate your instructor profile.</p>
                    </div>
                </div>
            </a><br><br>
        <?php else: ?>
            <a data-reset-tour='Instructor Tour' href = '<?php echo($this->baseUrl("/Instructor/Profile/1443")) ?>'>
                <div class="card">
                    <img class="card-img-top" src="<?php echo $this->publicUrl('images/InstructorProfile-StudentView.PNG')?>">
                    <div class="card-body">
                        <h5 class="card-title text-center">Instructor Profile</h5>
                        <p class="card-text">Learn how to navigate your instructor profile.</p>
                    </div>
                </div>
            </a>
        <?php endif; ?>
    </div>

    <div class="col-sm-6 col-lg-3 my-3">
        <?php if($currentUser->type == "student"): ?>
            <a data-reset-tour='Student Tour' href = '<?php echo($this->baseUrl("/Student/Profile/{$currentUser->id}")) ?>'>
                <div class="card">
                    <img class="card-img-top" src="<?php echo $this->publicUrl('images/StudentProfile-StudentView.PNG')?>">
                    <div class="card-body">
                        <h5 class="card-title text-center">Student Profile</h5>
                        <p class="card-text">Learn how to navigate your student profile.</p>
                    </div>
                </div>
            </a>
        <?php else: ?>
            <a data-reset-tour='Student Tour' href = '<?php echo($this->baseUrl("/Student/Profile/1447")) ?>'>
                <div class="card">
                    <img class="card-img-top" src="<?php echo $this->publicUrl('images/StudentProfile-InstructorView.PNG')?>">
                    <div class="card-body">
                        <h5 class="card-title text-center">Student Profile</h5>
                        <p class="card-text">Learn how to navigate your student profile.</p>
                    </div>
                </div>
            </a>
        <?php endif; ?>
    </div>

    <div class="col-sm-6 col-lg-3 my-3">
        <?php if($currentUser->type == "student"): ?>
            <a data-reset-tour='Student Edit Profile Tour' href = '<?php echo($this->baseUrl("/Student/ProfileEdit/{$currentUser->id}")) ?>'>
                <div class="card">
                    <img class="card-img-top" src="<?php echo $this->publicUrl('images/StudentEditProfile.PNG')?>">
                    <div class="card-body">
                        <h5 class="card-title text-center">Edit Student Profile</h5>
                        <p class="card-text">Learn how to edit your student profile.</p>
                    </div>
                </div>
            </a>
        <?php elseif($currentUser->type == "instructor"): ?>
            <a data-reset-tour='Instructor Edit Profile Tour' href = '<?php echo($this->baseUrl("/Instructor/EditProfile/{$currentUser->id}")) ?>'>
                <div class="card">
                    <img class="card-img-top" src="<?php echo $this->publicUrl('images/InstructorEditProfile.PNG')?>">
                    <div class="card-body">
                        <h5 class="card-title text-center">Edit Instructor Profile</h5>
                        <p class="card-text">Learn how to edit your instructor profile.</p>
                    </div>
                </div>
            </a>
        <?php endif; ?>
    </div>
</div>
