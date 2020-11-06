<?php
    $instructorInfo = User::find("id = :0:", $instructor->instructorid);
?>

<h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">
Reviews for <?php  echo $instructor->name . " " . $instructorInfo[0]->firstName . " " . $instructorInfo[0]->lastName?></h1>

<b>Note: </b> <i class="fas fa-check" style="color:green;"></i> next to a reviewer name confirms they have been enrolled in a course taught by this instructor.

<?php   $currentUser = User::getCurrentUser();
        $isStud = User::find("id = :0:", $currentUser->id);
        if ($isStud[0]->type == 'student') {
            echo "<a class = 'btn btn-secondary float-right' style='color: #ffffff;' href = '".$this->baseUrl("/Student/AddReview/{$instructor->instructorid}")."'>Add Review</a><br>";
        } //If the user is a student, ratings may be added
?>

<br>

<?php $reviews = InstructorRatings::find("instructor_id = :0:", $instructor->instructorid);?>

<?php 
    for ($counter = count($reviews)-1; $counter >= 0; $counter--) { ?>
    <div class = "card">
        <div class = "card-body">
            <?php echo $reviews[$counter]->printRating(); ?>
            <br>
        </div>
    </div>
    <br>
<?php } ?>

