<?php
$currentUser = User::getCurrentUser();
$profile = InstructorModel::getByKey($user->id);
echo "<h1 class='mb-3' style= 'background-color: #13284c; padding:60px; color: #ffffff;'>Welcome to ";
if($profile->name != NULL) {
    echo $profile->name." ";
}
echo $user->firstName." ".$user->lastName."'s profile!</h1>";
//Makes heading of professor's profile, with title if chosen
if($profile->instructorid == $currentUser->id) {
    echo "<a class = 'btn btn-secondary float-right' style='color: #ffffff;' href = '".$this->baseUrl("/Instructor/EditProfile/{$currentUser->id}")."'>Edit Profile</a>";
} //Allows user to edit profile if current profile is the user's profile
echo    "<br><h3 class = 'iprofile'>Department: $profile->department</h3><br>
        <p class = 'iprofile'>Email: $user->email</p><br>"; //Display's other instructor's information
echo    "<h3 class = 'iprofile'>Teaching Styles</h3><br>
        <table class='table table-bordered' id = 'learnstyles'>
            <tr>
                <th>Visual</th><th>Auditory</th><th>Reading/Writing</th><th>Kinesthetic</th>
            </tr>
            <tr>
                <th>$profile->visual</th><th>$profile->auditory</th><th>$profile->readwrite</th><th>$profile->kines</th>
            </tr>
        </table><br>"; //Display's instructor's preferred learning styles

$isStud = User::find("id = :0:", $currentUser->id);

if ($isStud[0]->type == 'student') {
    echo "<a href = '".$this->redirect($this->baseUrl("/Student/AddReview/{$profile->instructorid}"))."'>Add Review</a>";
} //If the user is a student, ratings may be added

echo "<br><br><br>";

//Will Instructors be able to view their reviews?
echo "<a href = '".$this->redirect($this->baseUrl("/Instructor/ViewReview/{$profile->instructorid}"))."'>View Reviews</a>";
?>