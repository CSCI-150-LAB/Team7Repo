<?php

class studentController extends Controller {

	public function ProfileEditAction() {
        $currentUser = User::getCurrentUser();

		//If the page was directed by a POST form
		if($this->request->isPost()) {
			$fields = [
                'major' => 'major',
				'name' => 'name',
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
				//Will get user after login
				$studentProfile = StudentModel::getByKey($currentUser->id);
				if (!$studentProfile) {
					$studentProfile = new StudentModel();
					$studentProfile->studentid = $currentUser->id;
				} //Checks for if there is a profile for this student. If not creates new student

				foreach ($studentData as $key => $val) {
					$studentProfile->$key = $val;
				} //Sets profile values for student

				if($studentProfile->save()) {
					return $this->redirect($this->viewHelpers->baseUrl("/User/studentPage"));
				} //Redirects student to profile page
				else {
					$errors[] = 'Failed to save the profile';
				} //If errors, save error
			}
		}

		return $this->view(['errors' => $errors, 'edit' => True]);
	} //If errors, return to edit profile page with errors

	public function ProfileAction($userId = 0) {
		$user = User::getByKey($userId);

		return $this->view(['user' => $user]);
	}
}