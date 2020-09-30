<div class="container">
	<?php
	echo '<pre>';
	$user = User::getCurrentUser();
	//var_dump($user);
	if($user->type == 'professor') {
		//If current user is an instructor, takes to instructor's profile page and passes all user data
		InstructorController::ViewProfileAction();
	}
	echo '</pre>';
	?>
</div>