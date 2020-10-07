<?php

class studentController extends PermsController {

	/**
	 * @IsStudentUser
	 * @MustBeLoggedIn
	 * @IsCurrentUser
	 */
	public function ProfileEditAction($userId) {
        $editUser = User::getByKey($userId);
		/**
		 * @var StudentModel
		 */
		$profile = $editUser->getProfileModel();

		//If the page was directed by a POST form
		if($this->request->isPost()) {
			$fields = [
                'major' => 'major',
				'learningstyle' => 'learningstyle'
			]; //Create an array of student information

            $studentData = [];
            $errors = [];
			foreach($fields as $prop => $postField) {
				if(empty($_POST[$postField])) {
					$errors[] = "{$postField} is required";
				}
				else {
					$studentData[$prop] = $_POST[$postField];
				}
            } //Check that all values are filled
            
			if(!count($errors)) {
				foreach ($studentData as $key => $val) {
					$profile->$key = $val;
				} //Sets profile values for student

				if($profile->save()) {
					return $this->redirect($editUser->getProfileUrl());
				} //Redirects student to profile page
				else {
					$errors[] = 'Failed to save the profile';
				} //If errors, save error
			}
		}

		return $this->view(['profile' => $profile, 'errors' => $errors, 'edit' => True]);
	} //If errors, return to edit profile page with errors

	public function ProfileAction($userId = 0) {
		$user = User::getByKey($userId);

		return $this->view(['user' => $user]);
	}

	public function DashboardAction($studentId = 1438) {

		return $this->view();

	}

}