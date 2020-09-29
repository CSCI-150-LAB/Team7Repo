<?php
echo "<h1 class = 'iprofile'>Welcome to ";
if($profile->preferred_title != NULL) {
    echo $profile->preferred_title." ";
}
echo "$profile->firstName $profile->lastName's profile!</h1><br>";
//Makes heading of professor's profile, with title if chosen
if(($profile->id == $user->id)) {
    echo "<button type = 'button' onclick = echo $this->partial('InstructorProfileEdit', ['user' => $user]);>Edit Profile</button>";
} //Allows user to edit profile if current profile is the user's profile
echo    "<h3 class = 'iprofile'>$profile->email</h3><br>
        <h3 class = 'iprofile'>$profile->department</h3><br>";
echo    "<h3 class = 'iprofile'>Teaching Styles</h3><br>
        <table class = 'iprofile' id = 'learnstyles'>
            <tr>
                <th>Visual</th><th>Auditory</th><th>Reading/Writing</th><th>Kinesthetic</th>
            </tr>
            <tr>
                <th>$profile->visual</th><th>$profile->auditory</th><th>$profile->read_write</th><th>$profile->kines</th>
            </tr><br>";
echo "<h3 class = 'iprofile'>Classes</h3><br>";