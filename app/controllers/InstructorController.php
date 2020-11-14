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
		$profile = InstructorModel::getByKey($user->id);
		if($profile == NULL) {
			if($user->isLoggedIn()) {
				return $this->redirect($this->viewHelpers->baseUrl("/Instructor/EditProfile/{$user->id}"));
			}
			else {
				return $this->redirect($this->viewHelpers->baseUrl());
			}
		}
		return $this->view(['user' => $user]);
	} //Send to profile page of userId

	public function AddClassAction() {
		$currentUser = User::getCurrentUser();
		$errors = [];

		if($this->request->isPost()) {
			//If the page was directed by a POST form
			$fields = [
				'class' => 'Class Title',
				'description' => 'Class Description',
				'starttime' => 'Start time',
				'endtime' => 'End time'
			]; //Create an array of class information

			$classData = [];
			$noDaysSelected = true;
			foreach (InstructorClasses::dayMap as $field => $_) {
				if (!empty($_POST[$field])) {
					$classData[$field] = 1;
					$noDaysSelected = false;
				}
			}
			if ($noDaysSelected) {
				$errors['days'] = 'Please pick a day the class meets';
			}

			foreach($fields as $prop => $errorStr) {
				if(empty($_POST[$prop])) {
					$errors[$prop] = "{$errorStr} is required";
				}
				else {
					$classData[$prop] = $_POST[$prop];
				}
			} //Check that all values are filled
			if(!count($errors)) {
				$instructorClass = new InstructorClasses();
				$instructorClass->instructorid = $currentUser->id;

				foreach ($classData as $key => $val) {

					
					$instructorClass->$key = $val;
				} //Sets class values for class

				if($instructorClass->save()) {
					return $this->redirect($this->viewHelpers->baseUrl('/Instructor/Dashboard'));
				} //Redirects user to main page
				else {
					$errors['_form'] = 'Failed to save the profile';
				} //If errors, save error
			}
			
		}
		return $this->view(['errors' => $errors]);
	}

	public function ViewClassAction($classid = 0) {
		$class = InstructorClasses::getByKey($classid);
		$currentUser = User::getCurrentUser();

		if (!$class || ($currentUser->type != 'admin' && $class->instructorid != $currentUser->id)) {
			return $this->redirect($this->viewHelpers->baseUrl());
		}

		return $this->view(['class' => $class]);
	} //Send to class page of given class id

	public function AddStudentAction($classid = 0) {
		if($classid == 0) {
			return $this->redirect($this->viewHelpers->baseUrl());
		}

		if($this->request->isPost()) {
			//If the page was directed by a POST form
			$fields = [
				'email' => 'email'
			]; //Add student's email

            $errors = [];
			foreach($fields as $prop => $postField) {
				if(empty($_POST[$postField])) {
					$errors[] = "{$postField} is required";
				}
				else {
					$student = User::find("email =:0:", $_POST['email']);
					$user = User::getByKey($student[0]->id);
				}
			} //Check that all values are filled
			if(!count($errors)) {
				$studentClass = new studentClasses();
				$studentClass->classId = $classid;
				$studentClass->studentId = $user->id;
				//Add new student to the class

				if($studentClass->save()) {
					return $this->redirect($this->viewHelpers->baseUrl("/Instructor/ViewClass/{$classid}"));
				} //Redirects user to main page
				else {
					$errors[] = 'Failed to save the profile';
				} //If errors, save error
			}
			
		}
		return $this->view(['errors' => $errors, 'classid' => $classid, 'student' => $studentClass->studentId]);
	}

	public function AddCSVStudentsAction($classid = 0) {
		if($classid == 0) {
			return $this->redirect($this->viewHelpers->baseUrl());
		}
		if($this->request->isPost()) {
			//If the page was directed by a POST form

			$errors = [];
			$users = [];
			if($_FILES['csv']['size'] > 0) {
				$csv = $_FILES['csv']['tmp_name'];
				$emails = array_map('str_getcsv', file($csv));
				foreach($emails as $email) {
					foreach($email as $em) {
						$student = User::findOne("email =:0:", $em);
						if($student) {
							$users[] = $student;
						}
						else {
							$errors[] = "user with email {$em} not found";
						}
					}
				}
				foreach($users as $student) {
					$registered = studentClasses::findOne("studentId =:0: AND classId =:1:", $student->id, $classid);
					if(!$registered) {
						$studentClass = new studentClasses();
						$studentClass->classId = $classid;
						$studentClass->studentId = $student->id;
						if(!$studentClass->save()) {
							$errors[] = "failed to add user with email {$student->email}";
						}
					}
				}
				//Add new student to the class
				$_SESSION['add_student_errors'] = $errors;
				return $this->redirect($this->viewHelpers->baseUrl("/Instructor/ViewClass/{$classid}"));
				//Redirects user to main page
			}
			else {
				$errors[] = "file is required";
			}
			
		}
		return $this->view(['errors' => $errors, 'classid' => $classid]);
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
			$searchQuery = str_replace('%', '%%', $search);

			$results = User::query(
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
		}

		return $this->view(compact('search', 'results'));
	}

	public function ViewReviewsAction($instructId = 0) {
		$instructor = User::getByKey($instructId);
		return $this->view(['instructor' => $instructor]);
	//Go to page of reviews for instructor
	}
}
