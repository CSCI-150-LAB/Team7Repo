<?php
echo "<h1 class = 'iprofile'>Welcome to ";
if($user->preferred_title != NULL) {
    echo $user->preferred_title." ";
}
echo "$user->firstName $user->lastName's profile!</h1><br>";
//Makes heading of professor's profile, with title if chosen
echo    "<p class = 'iprofile'>$user->email</p><br>
        <p class = 'iprofile'>$user->department</p><br>";
echo    "<table class = 'iprofile' id = 'learnstyles'>
            <tr>
                <th>Visual</th><th>Auditory</th><th>Reading/Writing</th><th>Kinesthetic</th>
            </tr>
            <tr>
                <th>$user->visual</th><th>$user->auditory</th><th>$user->read_write</th><th>$user->kines</th>
            </tr>";