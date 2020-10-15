<?php
    $instructorInfo = User::find("id = :0:", $instructor->instructorid);
?>

<h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">
Reviews for <?php  echo $instructor->name . " " . $instructorInfo[0]->firstName . " " . $instructorInfo[0]->lastName?></h1>

Rating: 

<?php $reviews = InstructorRatings::find("instructor_id = :0:", $instructor->instructorid);

foreach ($reviews as $value) {
    echo $value->rating . "/5 stars";
    echo "<br><br>";
    echo "Recommendation: <br><br>";
    echo $value->recommendation;
    echo "<br><br> Contributed By: <br>";
    if ($value->authorId == 0) {
        echo "Anonymous";
    }
    else {
        $student = User::find("id = :0:", $value->authorId);
        echo $student[0]->firstName . " " . $student[0]->lastName;
    }

    echo "<br><br>---------------------------------------------------<br><br>";
} ?>

