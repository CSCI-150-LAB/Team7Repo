<div class="container">
	<?php
	echo '<pre>';
	var_dump($user);
	if($user->type == 'professor') {
		echo $this->partial('InstructorProfile', ['user' => $user]);
	}
	//If current user is an instructor, takes to instructor's profile page and passes all user data
	echo '</pre>';
	?>
</div>