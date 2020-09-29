<div class="container">
	<?php
	echo '<pre>';
	//var_dump($user);
	if($user->type == 'professor') {
		$edit = False;
		if($user->department == NULL) {
    		$edit = True;
		}
		if($edit == True) {
			echo $this->partial('InstructorProfileEdit', ['user' => $user, 'profile' => $profile]);
		}
		else {
			echo $this->partial('InstructorProfile', ['user' => $user, 'profile' => $profile]);
		}
	}
	//If current user is an instructor, takes to instructor's profile page and passes all user data
	echo '</pre>';
	?>
</div>