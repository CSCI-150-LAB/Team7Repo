<h1 class="mb-3" style= "background-color: #13284c; padding:60px; color: #ffffff;">
Reviews for <?php  
$instructorInfo = InstructorModel::findOne("id = :0:", $instructor->id);
if($instructorInfo) {
    echo $instructorInfo->name . " ";
}
    echo $instructor->firstName . " " . $instructor->lastName?></h1>

<b>Note: </b> <i class="fas fa-check" style="color:green;"></i> next to a reviewer name confirms they have been enrolled in a course taught by this instructor.

<?php   $currentUser = User::getCurrentUser();
        $isStud = User::find("id = :0:", $currentUser->id);
        if ($isStud[0]->type == 'student') {
            echo "<a class = 'btn btn-secondary float-right' style='color: #ffffff;' href = '".$this->baseUrl("/Student/AddReview/{$instructor->id}")."'>Add Review</a><br>";
        } //If the user is a student, ratings may be added
?>

<br>

<?php $reviews = InstructorRatings::find("instructor_id = :0:", $instructor->id);?>


<?php   if($currentUser->type != "admin") { //Allows admin to delete reviews
                for ($counter = count($reviews)-1; $counter >= 0; $counter--) { ?> 
                    <div class = "card"> 
                        <div class = "card-body"> 
                            <?php echo $reviews[$counter]->printRating(); ?>
                            <br>
                        </div>
                    </div>
                    <br>
       <?php }
       } else { 
            for ($counter = count($reviews)-1; $counter >= 0; $counter--) { ?> 
                <div class = "card"> 
                    <div class = "card-body"> 
                        <?php echo $reviews[$counter]->printRating(); ?>
                        <br>
                        <br>
                        <button type="button" class="btn btn-danger" style ="text-align:right"><a href="InstructorController.php?id=<?php echo $rating;?>"> Delete </a></button>
                    </div>
                </div>
                <br>
        <?php } 
    }?>

<?php 
/*
Pervious code before admin code was added:
    for ($counter = count($reviews)-1; $counter >= 0; $counter--) { ?>
    <div class = "card">
        <div class = "card-body">
            <?php echo $reviews[$counter]->printRating(); ?>
            <br>
        </div>
    </div>
    <br>
<?php } */?>
