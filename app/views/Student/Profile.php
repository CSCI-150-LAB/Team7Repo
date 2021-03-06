<?php
	$this->pageTitle('Profile');
?>

<body id="profile-style">
    <div class="container">
        <div class="main-body" id="red-paw-background">
        <h1 class="mb-3 p-5 text-white bg-blue">
	        Student Profile</h1>
          <button class = 'btn btn-secondary float-md-right text-white' data-start-tour="Student Tour">Help</button><br><br> 
        <?php
          $profile = StudentModel::getByKey($user->id);
          $currentUser = User::getCurrentUser();
		  if(($user->id == $currentUser->id) || ($currentUser->type == "admin")):  //Allows user to edit profile if current profile is the user's profile ?>
		  <div class="text-right">
			  <a class = 'btn btn-secondary mb-3 text-white editprofile' href='<?= $this->baseUrl('/Student/ProfileEdit/' . $user->id) ?>'>Edit Profile</a>
		  </div>
		  <?php endif; ?>
		  
              <div class="row gutters-sm">
              
                <div class="col-lg-4 mb-3">
                  <div class="card studentprofile">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                      
                        <img src="<?php echo $user->getProfileImageSrc() ?>" alt="pic" class="rounded-circle" width="150">
                        <div class="mt-3">
                          <h4><?php echo $user->getFullName()?></h4>
                          <p class="text-secondary mb-1"><?php echo $profile->studentMajor?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap studentemail">
                        <h6 class="mb-0">Email</h6>
                        <span class="text-secondary"><?php echo $user->email?></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap preferredlearningstyle">
                        <h6 class="mb-0">Preferred Learning Style </h6>
                        <span class="text-secondary"><?php echo $profile->learningStyle?></span>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="col-lg-8">
                  <?php if($user->id == $currentUser->id): ?>
                  <div class="card mb-3">
                    <div class="card-body">
                        <h6 class="mb-0">Welcome to your profile</h6>
                    </div>
                  </div>
                  <?php endif; ?>

                  <div class="row gutters-sm">
                    <div class="col-sm-6 mb-3">
                      <div class="card h-100 learningstyles">
                        <div class="card-body" >
                          <h6 class="d-flex align-items-center mb-3">Other Learning Styles</h6>
                          <small>Visual</small>
                            <div><progress value="<?php echo $profile->visual?>" max="10"></progress></div>
                          <small>Kinesthetic</small>
                            <div><progress value="<?php echo $profile->kinesthetic?>" max="10"></progress></div>
                          <small>Audio</small>
                            <div><progress value="<?php echo $profile->audio?>" max="10"></progress></div>
                          <small>Reading / Writing</small>
                            <div><progress value="<?php echo $profile->reading_writing?>" max="10"></progress></div>
                        </div>
                      </div>
                    </div>
                    
                  <div class="col-sm-6 mb-3">
                    <div class="card h-100 learningtools">
                      <div class="card-body">
                        <h6 class="d-flex align-items-center mb-3"><i class="fas fa-tools mr-2"></i> Preferred Learning Tools</h6>
                        <small> Visual Tool: <?php echo $profile->visual_tool?> </small>
                        <br>
                        <small> Audio Tool: <?php echo $profile->audio_tool?></small>
                        <br>
                        <small> Kinesthetic Tool: <?php echo $profile->kinesthetic_tool?></small>
                        <br>
                        <small> Reading/Writing Tool: <?php echo $profile->read_write_tool?></small>
                        <br>
                    </div>
                  </div>

                  </div>
                </div>
              </div>
            </div>
        </div>
</body>	
