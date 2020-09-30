<div class="container">
	<?php
	echo '<pre>';
	$user = User::getCurrentUser();
	//var_dump($user);
	if($user->type == 'professor') {
		//If current user is an instructor, takes to instructor's profile page and passes all user data
		$profile = InstructorUser::getByKey($user->id);
		if(($profile->department == NULL)) {
			//If no profile set up, set edit to true to send to edit page
    		$edit = True;
		}
		else {
			$edit = False;
		}
		if($edit == True) {
			echo $this->partial('InstructorProfileEdit', ['user' => $user, 'profile' => $profile, 'errors' => $errors]);
			//If editting, send to edit form page
		}
		else {
			echo $this->partial('InstructorProfile', ['user' => $user, 'profile' => $profile]);
			//If not editting, send to user profile
		}
	}
	echo '</pre>';
	?>
</div>