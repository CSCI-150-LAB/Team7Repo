<?php

class InstructorController extends PermsController {

	/**
	 * @IsInstructorUser
	 * @MustBeLoggedIn
	 * @IsCurrentUser
	 */
	public function EditProfileAction($userId = 0) {
		$editUser = User::getByKey($userId);
		/**
		 * @var InstructorModel
		 */
		$profile = $editUser->getProfileModel();

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
				foreach ($instructorUserData as $key => $val) {
					$profile->$key = $val;
				} //Sets profile values for user

				if($profile->save()) {
					return $this->redirect($this->viewHelpers->baseUrl("/Instructor/Profile/{$profile->instructorid}"));
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

	public function DashboardAction() {
		return $this->view();
	}
}
