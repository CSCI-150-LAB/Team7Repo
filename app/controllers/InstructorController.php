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

	public function AddClassAction() {
		$currentUser = User::getCurrentUser();
		if($this->request->isPost()) {
			//If the page was directed by a POST form
			$starthour = $_POST['starthour'];
			$finhour = $_POST['finhour'];
			$starttime = '';
			$endtime = '';
			if($_POST['start'] == 'AM') {
				$starttime = $_POST['starthour'].':'.$_POST['startminute'].':00';
			}
			elseif($_POST['start'] == 'PM') {
				$starttime = strval(intval($starthour)+12).':'.$_POST['startminute'].':00';
			}
			else {
				$starttime = NULL;
			}
			if($_POST['fin'] == 'AM') {
				$endtime = $_POST['finhour'].':'.$_POST['finminute'].':00';
			}
			elseif($_POST['fin'] == 'PM') {
				$endtime = strval(intval($finhour)+12).':'.$_POST['finminute'].':00';
			}
			else {
				$endtime = NULL;
			}
			$fields = [
				'class' => 'class',
				'description' => 'description'
			]; //Create an array of class information

            $classData = [];
            $errors = [];
			foreach($fields as $prop => $postField) {
				if(empty($_POST[$postField])) {
					$errors[] = "{$postField} is required";
				}
				else {
					$classData[$prop] = $_POST[$postField];
				}
			} //Check that all values are filled
			if(empty($_POST['starthour']) || empty($_POST['startminute']) || empty($_POST['start']) || empty($_POST['finhour']) || empty($_POST['finminute']) || empty($_POST['fin'])) {
				$errors[] = "start/end time is required";
			} //Checks that class times are filled
			if(!count($errors)) {
				$instructorClass = new InstructorClasses();
				$instructorClass->instructorid = $currentUser->id;
				$instructorClass->starttime = $starttime;
				$instructorClass->endtime = $endtime;
				$instructorClass->Mon = $_POST['Mon'];
				$instructorClass->Tue = $_POST['Tue'];
				$instructorClass->Wed = $_POST['Wed'];
				$instructorClass->Thur = $_POST['Thur'];
				$instructorClass->Fri = $_POST['Fri'];
				$instructorClass->Sat = $_POST['Sat'];
				$instructorClass->Sun = $_POST['Sun'];
				//Creates new class with nonrequired values

				foreach ($classData as $key => $val) {
					$instructorClass->$key = $val;
				} //Sets class values for class

				if($instructorClass->save()) {
					return $this->redirect($this->viewHelpers->baseUrl());
				} //Redirects user to main page
				else {
					$errors[] = 'Failed to save the profile';
				} //If errors, save error
			}
			
		}
		return $this->view(['errors' => $errors]);
	}

	public function ViewClassesAction() {
		$currentUser = User::getCurrentUser();
		$classes = InstructorClasses::getByKey($currentUser->id);
		return $this->view->partial(['classes' => $classes]);
	} //Show the list of classes instructor has
	
	public function DashboardAction() {
		return $this->view();
	}
}
