<?php
    $currentUser = User::getCurrentUser();
	$this->pageTitle("Dashboard");
?>

<h1 class="mb-3 p-5 text-white bg-blue">Help Page: view tutorials for FeedbackLoop here</h1><br><br>

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
