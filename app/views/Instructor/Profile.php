<?php
/** @var User $user */
$this->scriptEnqueue('chart-js', 'https://cdn.jsdelivr.net/npm/chart.js@2.8.0');
$currentUser = User::getCurrentUser();
$profile = InstructorModel::getByKey($user->id);

$this->pageTitle("{$user->preferredTitle} {$user->lastName} - Profile");
?>
<div class="bg-blue p-5 text-white mb-3">
	<h1 class="mb-0">Instructor Profile</h1>
</div>
<button class = 'btn btn-secondary float-md-right text-white' onclick = 'instrProfTut()'>Help</button><br><br> 
<?php
	if(($profile->instructorid == $currentUser->id) || ($currentUser->type == "admin")) {
	echo "<a class = 'btn btn-secondary float-md-right text-white editprofile' href = '".$this->baseUrl("/Instructor/EditProfile/{$currentUser->id}")."'>Edit Profile</a><br><br>";
} //Allows user to edit profile if current profile is the user's profile ?>
<div class="d-flex flex-column flex-md-row instructorinfo">
	<img src="<?php echo $this->publicUrl('images/blank_avatar.png')?>" width="250" alt="blank_avatar" class="mr-md-4 mb-3 img-fluid">
	<div class="w-100">
		<div class="text-md-right mb-3">
			<div class="float-md-right starrating">
				<?php echo PrintHelpers::printStarRating($profile->rating) ?>
			</div>
		</div>
		<div>
			<!--Makes heading of professor's profile, with title if chosen-->
			<h2><?= $user->getFullName(true) ?></h2>
			<h3 class="mb-2"><?= $profile->department ?><br></h3>
			<div class="small text-truncate"><?= $user->email ?></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<div class="card p-3 mb-3">
			<div class="card-body">
				<div class="teachingstyles">
					<h4 class="card-title text-center">Teaching Styles</h4>
					<b>Visual:</b> <?php echo $profile->visual ?> <br>
					<b>Auditory:</b> <?php echo $profile->auditory ?> <br>
					<b>Reading/Writing:</b> <?php echo $profile->readwrite ?> <br>
					<b>Kinesthetic:</b> <?php echo $profile->kines ?> <br><br>
				</div>
				<?php
				$ratings = InstructorRatings::find("instructor_id = :0:", $user->id);
				if($ratings) {
					$numTotalTA = 0;
					$numTA = 0;
					$numTotalGrades = 0;
					$A = 0;
					$B = 0;
					$C = 0;
					$D = 0;
					$F = 0;
					foreach($ratings as $rating) {
						if($rating->grade != "N/A") {
							$numTotalGrades += 1;
							if($rating->grade == 'A') {
								$A += 1;
							}
							elseif($rating->grade == 'B') {
								$B += 1;
							}
							elseif($rating->grade == 'C') {
								$C += 1;
							}
							elseif($rating->grade == 'D') {
								$D += 1;
							}
							elseif($rating->grade == 'F') {
								$F += 1;
							}
						}
						if($rating->takeAgain != "N/A") {
							$numTotalTA += 1;
							if($rating->takeAgain == 'Yes') {
								$numTA += 1;
							}
						}
					}
					$percentTA = ($numTA/$numTotalTA)*100;
					$arr = [$A, $B, $C, $D, $F];
					if($numTotalTA) {?>
					<div class = 'takeagain'>
						<h4 class="card-title text-center">Students would take again</h4>
						<div class="progress">
							<div class="progress-bar" role="progressbar" aria-valuenow=<?php echo $percentTA ?> aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentTA ?>%">
								<?php echo round($percentTA) ?>%
							</div>
						</div>
						<p class="text-center">Out of <?php echo $numTotalTA?> people who answered</p>
					</div>
					<?php }
					if($numTotalGrades) { ?>
					<div class = 'grades'>
						<h4 class="card-title text-center">Student grades</h4>
						<p class="text-center">Out of <?php echo $numTotalGrades?> people who answered</p>
						<canvas id="myChart"></canvas>
						<script>
							var ctx = document.getElementById('myChart').getContext('2d');
							var data = [<?php echo join(',',$arr); ?>];
							var myPieChart = new Chart(ctx, {
								type: 'pie',
								data: {
								datasets: [{
									backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
									data: <?php echo json_encode($arr, JSON_NUMERIC_CHECK); ?>
								}],
								labels: [
									'A',
									'B',
									'C',
									'D',
									'F'
								]
							}
							});
						</script>
					</div>
				<?php } } ?>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="card p-3 mb-3">
			<div class="card-body topreview">
				<h4 class="card-title text-center">Top Review</h4>
				<?php $reviews = InstructorRatings::find("instructor_id = :0: AND verified = :1:", $user->id, 1);
				if(!$reviews) {
					$reviews = InstructorRatings::find("instructor_id = :0:", $user->id);
				}
				if($reviews) {
					$topreview = $reviews[0];
					foreach($reviews as $review)  {
						if($review->rating > $topreview->rating) {
							$topreview = $review;
						}
					}
					if($topreview) {
						echo $topreview->printRating();
					}
				}
				else {
					echo "No recommendations yet";
					$currentUser = User::getCurrentUser();
					$isStud = User::find("id = :0:", $currentUser->id);
					if ($isStud[0]->type == 'student') {
						echo ", be the first! <a  href = '".$this->baseUrl("/Student/AddReview/{$user->id}")."'>Add Review >></a><br>";
					}
				}
				?>
			</div>
		</div>
		<div class="card p-3">
			<div class="card-body recentfeedback">
				<h4 class="card-title text-center">Recent Feedback</h4>
				<?php $reviews = InstructorRatings::find("instructor_id = :0:", $user->id);
				$recent = count($reviews)-1;
				if($recent >= 0) {
					echo $reviews[$recent]->printRating();
					echo '<br><br>';
				}
				else {
					echo "No recommendations yet";
					$currentUser = User::getCurrentUser();
					$isStud = User::find("id = :0:", $currentUser->id);
					if ($isStud[0]->type == 'student') {
						echo ", be the first! <a  href = '".$this->baseUrl("/Student/AddReview/{$user->id}")."'>Add Review >></a><br>";
					}
				}
				$recent -= 1;
				if($recent >= 0) {
					echo $reviews[$recent]->printRating();
					echo '<br><br>';
				}
				if($reviews) { ?>
					<a href = '<?php echo $this->baseUrl("/Instructor/ViewReviews/{$user->id}") ?>' class = 'card-link allreviews'>See all reviews <i class="fas fa-angle-double-right"></i></a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<script>
	function instrProfTut(){
		// Declare the tour
		var instructorProfileTutorial = new Tour({
			name: "instructor-tour",
			container: "body",
			smartPlacement: true,
			backdrop: true,
			backdropPadding: 5,
			// duration: 10000,
			storage: false,
			template: (i, step) => `
				<div class="popover" role="tooltip">
					<div class="arrow"></div>
					<h3 class="popover-header" data-progress="${i + 1} / ${instructorProfileTutorial._options.steps.length}"></h3>
					<div class="popover-body"></div>
					<div class="popover-navigation">
						<div class="btn-group">
							<button class="btn btn-sm btn-secondary" data-role="prev">&laquo; Prev</button>
							<button class="btn btn-sm btn-secondary" data-role="next">Next &raquo;</button>
							<button class="btn btn-sm btn-secondary" data-role="pause-resume" data-pause-text="Pause" data-resume-text="Resume">Pause</button>
						</div>
						<button class="btn btn-sm btn-secondary" data-role="end">End tour</button>
					</div>
				</div>
			`,
            steps: [
            {
                element: ".instructorinfo",
                title: "Instructor Profile",
				next: 1,
				prev:-1,
                content: "This is an instructor profile, here is basic information about the instructor."
            },
            {
                element: ".editprofile",
                title: "Edit Profile",
				next: 2,
				prev: 0,
                content: "You can update that information by pressing here, or you can continue this tour first and update your information later."
            },
            {
                element: ".starrating",
                title: "Rating",
				next: 3,
				prev: 1,
                content: "Here is this instructor's overall instructor rating based on all of their reviews.  You can hover your mouse over it to see the fractional value."
            },
			{
				element: ".teachingstyles",
				title: "Selected Teaching Styles",
				next: 4,
				prev: 2,
				content: "Here are the selected options for how frequently this instructor uses each of the four primary learning/teaching styles."
			},
			{
				element: ".topreview",
				title: "Top Review",
				next: 5,
				prev: 3,
				content: "This is the top review for this instructor based on the highest rating, and by a verified student if there is a review by a verified student."
			},
			{
				element: ".studentrating:first",
				title: "Given Rating",
				next: 6,
				prev: 4,
				content: "These stars represent the rating that student gave on a scale of 1 to 5 as seen by the stars."
			},
			{
				element: ".optionalresponses:first",
				title: "Class Information",
				next: 7,
				prev: 5,
				content: "Here is where students can leave optional information about the class they took with this instructor.  Options include if they would take the class again, if there was a lot of homework in the class, whether or not class attendance is required, and their self-reported grade."
			},
			{
				element: ".reviewinfo:first",
				title: "Review Description",
				next: 8,
				prev: 6,
				content: "This is where the student left personalized information about how they felt about the class or the instructor."
			},
			{
				element: ".author:first",
				title: "Reviewer",
				next: 9,
				prev: 7,
				content: "This is where the name of the student that left the review is if they decided not to be anonymous.  The green checkmark next to their name means they have been verified to have been in one of the instructor's classes."
			},
			{
				element: ".recentfeedback",
				title: "Recent Feedback",
				next: 10,
				prev: 8,
				content: "Here is where you will find up to the two most recent feedback for this instructor."
			},
			{
				element: ".allreviews",
				title: "See all reviews",
				next: 11,
				prev: 9,
				content: "You can click here to view all of the reviews this instructor has received."
			},
			{
				element: ".takeagain",
				title: "Who would take again?",
				next: 12,
				prev: 10,
				content: "If students have answered the optional question about whether they would take this instructor's class again, the percentage who responded yes out of those who responded will be shown here."
			},
			{
				element: ".grades",
				title: "Grade Distribution",
				prev: 11,
				content: "Based on the students who responded to the self-reported grade option, a distribution of those student's grades will appear here."
			}]
        });
	  
		// Initialize the tour
		instructorProfileTutorial.init();
	  
		// Start the tour
		instructorProfileTutorial.restart();
	  
	};
</script>