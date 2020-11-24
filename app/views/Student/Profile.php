<h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">Welcome to <?php  echo $user->firstName." ".$user->lastName?>
profile!
</h1><br>

<img src="<?php echo $this->publicUrl('images/blank_avatar.png')?>" width="200px" alt="blank_avatar">

<?php
    $profile = StudentModel::getByKey($user->id);
    $currentUser = User::getCurrentUser();
    if($user->id == $currentUser->id) {  //Allows user to edit profile if current profile is the user's profile
		echo "<a class = 'btn btn-secondary float-right' style='color: #ffffff;' href='" . $this->baseUrl('/Student/ProfileEdit/' . $user->id) . "'>Edit Profile</a>";
    } elseif ($currentUser->type == "admin") { //Allows any admin to edit instructor page
    echo "<a class = 'btn btn-secondary float-right' style='color: #ffffff;' href = '".$this->baseUrl("/Instructor/EditProfile/{$currentUser->id}")."'>Edit Profile</a><br><br>";
  } ?>

    echo    "<h3 class = 'sprofile'>$user->email</h3><br>";
           
    echo    "<h3 class = 'sprofile'>Preferred Learning Style: $profile->learningStyle </h3><br>";
    echo    "<h3 class = 'sprofile'>Major: $profile->studentMajor</h3>";
            
?>