<div class="container">
	<?php
	echo '<pre>';
	$user = User::getCurrentUser();
	//var_dump($user);
	if($user->type == 'professor') {
		$profile = InstructorUser::getByKey($user->id);
		var_dump($user);
		var_dump($profile);
		if($profile->department == NULL) {
    		$edit = True;
		}
		else {
			$edit = False;
		}
		if($edit == True) {
			echo $this->partial('InstructorProfileEdit', ['user' => $user, 'profile' => $profile, 'errors' => $errors]);
		}
		else {
			echo $this->partial('InstructorProfile', ['user' => $user, 'profile' => $profile]);
		}
	}
	//If current user is an instructor, takes to instructor's profile page and passes all user data
	echo '</pre>';
	?>
</div>