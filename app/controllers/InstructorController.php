<?php

class InstructorController extends Controller {

	public function EditProfileAction() {
		$currentUser = User::getCurrentUser();
		$profile = InstructorModel::getByKey($currentUser->id);

		if($this->request->isPost()) {
			//If the page was directed by a POST form
			$fields = [
				'department' => 'department',
				'name' => 'name',
				'visual' => 'visual',
				'auditory' => 'auditory',
                'readwrite' => 'readwrite',
                'kines' => 'kines'
			]; //Create an array of profile information

            $instructorUserData = [];
            $errors = [];
			foreach($fields as $prop => $postField) {
				if(empty($_POST[$postField])) {
					$errors[] = "{$postField} is required";
				}
				else {
					$instructorUserData[$prop] = $_POST[$postField];
				}
			} //Check that all values are filled
			if(!count($errors)) {
				$instructorUserProfile = InstructorModel::getByKey($currentUser->id);
				if (!$instructorUserProfile) {
					$instructorUserProfile = new InstructorModel();
					$instructorUserProfile->instructorid = $currentUser->id;
				} //Checks for if there is already a profile for this user, if not creates new user

				foreach ($instructorUserData as $key => $val) {
					$instructorUserProfile->$key = $val;
				} //Sets profile values for user

				if($instructorUserProfile->save()) {
					return $this->redirect($this->viewHelpers->baseUrl("/Instructor/Profile/{$currentUser->id}"));
				} //Redirects user to profile page
				else {
					$errors[] = 'Failed to save the profile';
				} //If errors, save error
			}
		}

		return $this->view(['profile' => $profile]);
	} //If errors, return to edit profile page with errors

	public function ProfileAction($userId = 0) {
		$user = User::getByKey($userId);
		$currentUser = User::getCurrentUser();
		$profile = InstructorModel::getByKey($currentUser->id);
		if($profile == NULL) {
			return $this->redirect($this->viewHelpers->baseUrl("/Instructor/EditProfile"));
		}
		return $this->view(['user' => $user]);
	} //Send to profile page of userId
}
