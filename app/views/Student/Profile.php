<?php
	$this->pageTitle('Profile');
?>

<body id="profile-style">
    <div class="container">
        <div class="main-body" id="red-paw-background">
        <?php
          $profile = StudentModel::getByKey($user->id);
          $currentUser = User::getCurrentUser();
		  if($user->id == $currentUser->id):  //Allows user to edit profile if current profile is the user's profile ?>
		  <div class="text-right">
			  <a class = 'btn btn-secondary mb-3 text-white' href='<?= $this->baseUrl('/Student/ProfileEdit/' . $user->id) ?>'>Edit Profile</a>
		  </div>
		  <?php endif; ?>
		  
              <div class="row gutters-sm">
              
                <div class="col-lg-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                      
                        <img src="<?php echo $this->publicUrl('images/blank_avatar.png')?>" alt="pic" class="rounded-circle" width="150">
                        <div class="mt-3">
                          <h4><?php echo $currentUser->getFullName()?></h4>
                          <p class="text-secondary mb-1"><?php echo $profile->studentMajor?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Email</h6>
                        <span class="text-secondary"><?php echo $currentUser->email?></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Preferred Learning Style </h6>
                        <span class="text-secondary"><?php echo $profile->learningStyle?></span>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="col-lg-8">
                  <div class="card mb-3">
                    <div class="card-body">
                        <h6 class="mb-0">Welcome to your profile</h6>
                    </div>
                  </div>

                  <div class="row gutters-sm">
                    <div class="col-sm-6 mb-3">
                      <div class="card h-100">
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
                    <div class="card h-100">
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
