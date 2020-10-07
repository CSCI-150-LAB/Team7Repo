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
		$profile = InstructorModel::getByKey($user->id);
		if($profile == NULL) {
			return $this->redirect($this->viewHelpers->baseUrl("/Instructor/EditProfile"));
		}
		return $this->view(['user' => $user]);
	} //Send to profile page of userId

	public function AddClassAction() {
		$currentUser = User::getCurrentUser();
		if($this->request->isPost()) {
			//If the page was directed by a POST form
			$fields = [
				'class' => 'class',
				'description' => 'description',
				'starttime' => 'starttime',
				'endtime' => 'endtime'
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
			if(!count($errors)) {
				$instructorClass = new InstructorClasses();
				$instructorClass->instructorid = $currentUser->id;
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

	public function DashboardAction() {
		$user = User::getCurrentUser();
		return $this->view(['user' => $user]);
	}

	public function SearchAction($search = '', $page = 1) {
		if (isset($_GET['search'])) {
			$search = $_GET['search'];
		}
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		}
		if (!is_numeric($page)) {
			$page = 1;
		}
		
		$results = [];

		if ($search !== '') {
			/** @var Db */
			$db = $this->get('Db');
			$searchQuery = str_replace('%', '%%', $search);

			$results = $db->query(
				"
				SELECT
				(
					IF(u.email LIKE :0:, 1, 0) + 
					IF(u.first_name LIKE :0:, 1, 0) + 
					IF(u.last_name LIKE :0:, 1, 0) + 
					IF(CONCAT(u.first_name, ' ', u.last_name) LIKE :0:, 1, 0) +
					IF(ip.department LIKE :0:, 0.2, 0) + 
					IF(
						(
							SELECT
								COUNT(*)
							FROM
								instructorclasses as ic
							WHERE
								ic.instructor_id = u.id AND
								ic.class_title LIKE :0:
						) > 0,
						1,
						0
					)
				) as score,
				u.*
				FROM
					users as u
				LEFT JOIN instructorprofile as ip ON
					ip.id = u.id
				WHERE
					u.type = 'instructor'
				HAVING
					score > 0
				ORDER BY
					score DESC
				LIMIT :1:, 10
				",
				"%{$searchQuery}%",
				max(0, ($page - 1)) * 10
			);

			$results = array_map(['User', 'fromArray'], $results);
		}

		return $this->view(compact('search', 'results'));
	}
}
