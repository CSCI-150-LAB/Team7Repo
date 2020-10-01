<?php
    $profile = studentModel::getByKey($user->id);
    echo "<h1 class = 'sprofile'>Welcome ";
    if($profile->name != NULL) {
        echo $profile->name." ";
    }

    echo $user->firstName." ".$user->lastName."'s profile!</h1><br>";
    //Makes heading of professor's profile, with title if chosen
    if($profile->studentid == $user->id) {
		echo "<a href='" . $this->baseUrl('/Student/ProfileEdit/' . $user->id) . "'>Edit Profile</a>";
        echo "<button type = 'button' onclick = ''>Edit Profile</button>";
    } //Allows user to edit profile if current profile is the user's profile
    echo    "<h3 class = 'sprofile'>$user->email</h3><br>
            <h3 class = 'sprofile'>$profile->major</h3><br>";
    echo    "<h3 class = 'sprofile'>Learning Styles</h3><br>
            <table class = 'sprofile' id = 'learnstyles'>";
?>