<?php
$currentUser = User::getCurrentUser();
$profile = InstructorModel::getByKey($user->id);
echo "<h1 class = 'iprofile'>Welcome to ";
if($profile->name != NULL) {
    echo $profile->name." ";
}
echo $user->firstName." ".$user->lastName."'s profile!</h1><br>";
//Makes heading of professor's profile, with title if chosen
if($profile->instructorid == $currentUser->id) {
    echo "<a href = '".$this->baseUrl("/Instructor/EditProfile/{$currentUser->id}")."'>Edit Profile</a>";
} //Allows user to edit profile if current profile is the user's profile
echo    "<h3 class = 'iprofile'>Email: $user->email</h3><br>
        <h3 class = 'iprofile'>Department: $profile->department</h3><br>"; //Display's other instructor's information
echo    "<h3 class = 'iprofile'>Teaching Styles</h3><br>
        <table class = 'iprofile' id = 'learnstyles'>
            <tr>
                <th>Visual</th><th>Auditory</th><th>Reading/Writing</th><th>Kinesthetic</th>
            </tr>
            <tr>
                <th>$profile->visual</th><th>$profile->auditory</th><th>$profile->readwrite</th><th>$profile->kines</th>
            </tr>
        </table><br>"; //Display's instructor's preferred learning styles

if ($profile->instructorid != $currentUser->id) { //Modify later if another instructor tries rating another?
    $_SESSION['ratedInstructorId'] = $profile->instructorid;
    echo "<a href = '".$this->redirect($this->baseUrl("/Student/AddReview/"))."'>Add Review</a>";
} //If the user is not the instructor, ratings may be added
?>