<?php
$profile = InstructorUser::getByKey($user->id);
if($profile->instructorid == NULL) {
    
}
echo "<h1 class = 'iprofile'>Welcome to ";
if($profile->name != NULL) {
    echo $profile->name." ";
}
echo $user->firstName." ".$user->lastName."'s profile!</h1><br>";
//Makes heading of professor's profile, with title if chosen
if($profile->instructorid == $user->id) {
    echo "<button type = 'button' onclick = '"."'>Edit Profile</button>";
} //Allows user to edit profile if current profile is the user's profile
echo    "<h3 class = 'iprofile'>$user->email</h3><br>
        <h3 class = 'iprofile'>$profile->department</h3><br>"; //Display's other instructor's information
echo    "<h3 class = 'iprofile'>Teaching Styles</h3><br>
        <table class = 'iprofile' id = 'learnstyles'>
            <tr>
                <th>Visual</th><th>Auditory</th><th>Reading/Writing</th><th>Kinesthetic</th>
            </tr>
            <tr>
                <th>$profile->visual</th><th>$profile->auditory</th><th>$profile->readwrite</th><th>$profile->kines</th>
            </tr><br>"; //Display's instructor's preferred learning styles
echo "<h3 class = 'iprofile'>Classes</h3><br>"; //Displays instructor's current classes