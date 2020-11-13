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
                'studentMajor' => 'major',
				'learningStyle' => 'learningStyle'
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
	
	public function AddReviewAction($instructorId = 0) {
		$currentUser = User::getCurrentUser();
		if($this->request->isPost()) {
			//If the page was directed by a POST form
			$fields = [
				'rating' => 'rating',
				'recommendation' => 'recommendation',
				'anon' => 'anon'
			]; //Create an array to hold rating information

			$ratingInfo = [];
            $errors = [];
			foreach($fields as $property => $postField) {
				if(empty($_POST[$postField])) {
					$errors[] = "{$postField} is required";
				}
				else {
					$ratingInfo[$property] = $_POST[$postField];
				}
			} //Check that all values are filled
			if(!count($errors)) {
				$instructorRating = new InstructorRatings();
				if ($ratingInfo['anon'] == 'yes') {
					$instructorRating->authorId = 0; // make the id 0 if they want to be anonymous
				}
				else {
					$instructorRating->authorId = $currentUser->id; //store user id if they don't want to be anonymous
				}

				//$instructId = $_SESSION['ratedInstructorId'];
				if (isset($_POST['takeAgain'])) {
					$instructorRating->takeAgain = $_POST['takeAgain'];
				}
				else {
					$instructorRating->takeAgain = "N/A";
				}
				if (isset($_POST['attendanceRequired'])) {
					$instructorRating->attendanceRequired = $_POST['attendanceRequired'];
				}
				else {
					$instructorRating->attendanceRequired = "N/A";
				}
				if (isset($_POST['homework'])) {
					$instructorRating->homework = $_POST['homework'];
				}
				else {
					$instructorRating->homework = "N/A";
				}
				if (isset($_POST['grade'])) {
					$instructorRating->grade = $_POST['grade'];
				}
				else {
					$instructorRating->grade = "N/A";
				}

				$classes = InstructorClasses::find("instructorid =:0:", $instructorId);
				foreach($classes as $class) {
					$verify = studentClasses::find("classId =:0: AND studentId =:1:", $class->classid, $currentUser->id);
					if($verify) {
						$instructorRating->verified = 1;
					}
				}

				$instructorRating->instructorId = $instructorId;

				foreach ($ratingInfo as $key => $val) {
					$instructorRating->$key = $val;
				}

				if($instructorRating->save()) {
					// Update instructor profile rating
					/** @var Db */
					$db = $this->get('Db');
					$db->query("
						UPDATE
							instructorprofile as ip,
							(
								SELECT
									SUM(ir.rating) as sum,
									COUNT(*) as cnt
								FROM
									instructorratings as ir
								WHERE
									ir.instructor_id = :0:
								GROUP BY
									ir.instructor_id
							) as results
						SET
							ip.rating = results.sum / results.cnt
						WHERE
							ip.id = :0:;
					", $instructorId);
					
					return $this->redirect($this->viewHelpers->baseUrl("/Instructor/Profile/{$instructorId}"));
				} //Redirects user to instructor profile 
				else {
					$errors[] = 'Failed to save the review';
				} 
			}
		}
		return $this->view(['errors' => $errors, 'instructorId' =>$instructorId]);
	}

	public function AllResponsesAction() {
		return $this->view();
	}

}