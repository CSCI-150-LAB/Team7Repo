<?php
echo "<h1 class = 'iprofile'>Welcome to ";
if($user->preferred_title != NULL) {
    echo $user->preferred_title." ";
}
echo "$user->firstName $user->lastName's profile!</h1><br>";
//Makes heading of professor's profile, with title if chosen
if(($user->id == 2)) {
    echo "<button type = 'button' onclick = echo $this->partial('InstructorProfileEdit', ['user' => $user]);>Edit Profile</button>";
} //Allows user to edit profile if current profile is the user's profile
echo $this->baseUrl("/");
echo    "<h3 class = 'iprofile'>$user->email</h3><br>
        <h3 class = 'iprofile'>$user->department</h3><br>";
echo    "<h3 class = 'iprofile'>Teaching Styles</h3><br>
        <table class = 'iprofile' id = 'learnstyles'>
            <tr>
                <th>Visual</th><th>Auditory</th><th>Reading/Writing</th><th>Kinesthetic</th>
            </tr>
            <tr>
                <th>$user->visual</th><th>$user->auditory</th><th>$user->read_write</th><th>$user->kines</th>
            </tr><br>";
echo "<h3 class = 'iprofile'>Classes</h3><br>";