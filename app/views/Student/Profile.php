
<?php
    $profile = StudentModel::getByKey($user->id);
    $currentUser = User::getCurrentUser();
    if($user->id == $currentUser->id) {
		echo "<a class = 'btn btn-secondary float-right' style='color: #ffffff;' href='" . $this->baseUrl('/Student/ProfileEdit/' . $user->id) . "'>Edit Profile</a>";
    } //Allows user to edit profile if current profile is the user's profile

            
?>



<body id="profile-style">
    <div class="container">
        <div class="main-body" id="red-paw-background">
              <div class="row gutters-sm">
              
                <div class="col-md-4 mb-3">
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
                        <h6 class="mb-0">Preferred Learning Style</h6>
                        <span class="text-secondary"><?php echo $profile->learningStyle?></span>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="col-md-8">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">My Bio</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                         <input type="textarea" width="100px" height="150px">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row gutters-sm">
                    <div class="col-sm-6 mb-3">
                      <div class="card h-100">
                        <div class="card-body" >
                          <h6 class="d-flex align-items-center mb-3">Other Learning Styles</h6>
                          <small>Visual</small>
                          <div class="progress mb-3" style="height: 5px">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <small>Kinesthetic</small>
                          <div class="progress mb-3" style="height: 5px">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <small>Audio</small>
                          <div class="progress mb-3" style="height: 5px">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <small>Reading / Writing</small>
                          <div class="progress mb-3" style="height: 5px">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  <div class="col-sm-6 mb-3">
                    <div class="card h-100">
                      <div class="card-body">
                        <h6 class="d-flex align-items-center mb-3"><i class="fas fa-tools"></i> Preferred Learning Tools</h6>
                        <small>Web Design</small>
                        <div class="progress mb-3" style="height: 5px">
                          <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small>Website Markup</small>
                        <div class="progress mb-3" style="height: 5px">
                          <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small>One Page</small>
                        <div class="progress mb-3" style="height: 5px">
                          <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small>Mobile Template</small>
                        <div class="progress mb-3" style="height: 5px">
                          <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small>Backend API</small>
                        <div class="progress mb-3" style="height: 5px">
                          <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                  </div>

                  </div>
                </div>
              </div>
            </div>
        </div>
</body>