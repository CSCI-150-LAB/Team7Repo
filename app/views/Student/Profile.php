<?php
    $profile = StudentModel::getByKey($user->id);
    echo "<h1 class = 'sprofile'>Welcome to ";
    if($profile->name != NULL) {
        echo $profile->name." ";
    }

    echo $user->firstName." ".$user->lastName." profile!</h1><br>";
    //Makes heading of student profile, with title if chosen
    if($user->isLoggedIn()) {
		echo "<a href='" . $this->baseUrl('/Student/ProfileEdit/' . $user->id) . "'>Edit Profile</a>";
    } //Allows user to edit profile if current profile is the user's profile

    echo    "<h3 class = 'sprofile'>$user->email</h3><br>";
           
    echo    "<h3 class = 'sprofile'>Preferred Learning Style: $profile->learningStyle </h3><br>";
    echo    "<h3 class = 'sprofile'>Major: $profile->studentMajor</h3>";
            
?>