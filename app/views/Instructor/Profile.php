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
<?php if($profile->instructorid == $currentUser->id) {
	echo "<a class = 'btn btn-secondary float-md-right text-white' href = '".$this->baseUrl("/Instructor/EditProfile/{$currentUser->id}")."'>Edit Profile</a><br><br>";
} //Allows user to edit profile if current profile is the user's profile ?>
<div class="d-flex flex-column flex-md-row">
	<img src="<?php echo $this->publicUrl('images/blank_avatar.png')?>" width="250" alt="blank_avatar" class="mr-md-4 mb-3 img-fluid">
	<div class="w-100">
		<div class="text-md-right mb-3">
			<?php echo PrintHelpers::printStarRating($profile->rating) ?>
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
				<h4 class="card-title text-center">Teaching Styles</h4>
				<b>Visual:</b> <?php echo $profile->visual ?> <br>
				<b>Auditory:</b> <?php echo $profile->auditory ?> <br>
				<b>Reading/Writing:</b> <?php echo $profile->readwrite ?> <br>
				<b>Kinesthetic:</b> <?php echo $profile->kines ?> <br><br>
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
					<h4 class="card-title text-center">Students would take again</h4>
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow=<?php echo $percentTA ?> aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentTA ?>%">
							<?php echo round($percentTA) ?>%
						</div>
					</div>
					<p class="text-center">Out of <?php echo $numTotalTA?> people who answered</p>
					<?php }
					if($numTotalGrades) { ?>
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
				<?php } } ?>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="card p-3 mb-3">
			<div class="card-body">
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
			<div class="card-body">
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
					<a href = '<?php echo $this->baseUrl("/Instructor/ViewReviews/{$user->id}") ?>' class = 'card-link'>See all reviews <i class="fas fa-angle-double-right"></i></a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>