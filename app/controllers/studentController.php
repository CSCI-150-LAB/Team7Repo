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
		$errors = [];

		//If the page was directed by a POST form
		if($this->request->isPost()) {
			$fields = [
                'studentMajor' => 'major',
				'learningStyle' => 'learningStyle',
				'visual' => 'visual',
				'audio' => 'audio',
				'kinesthetic' => 'kinesthetic',
				'reading_writing' => 'readingwriting',
				'visual_tool' => 'visual-tools',
				'audio_tool' => 'audio-tools',
				'kinesthetic_tool' => 'kinesthetic-tools',
				'read_write_tool' => 'rw-tools'
			]; //Create an array of student information

            $studentData = [];
			foreach($fields as $prop => $postField) {
				if(empty($_POST[$postField])) {
					$errors[] = "{$postField} is required";
				}
				else {
					$studentData[$prop] = $_POST[$postField];
				}
            } //Check that all values are filled

			// Verify profile image type - must be last thing before following if
			$newFileId = null;
			if (isset($_FILES['profile-image'])) {
				$imgPost = $_FILES['profile-image'];
				$ext = pathinfo($imgPost['name'], PATHINFO_EXTENSION);
				
				if (!in_array(strtolower($ext), ['gif', 'jpg', 'jpeg', 'png'])) {
					$errors[] = 'Profile image must be: .gif, .jpg, .jpeg, .png';
				}

				if (!count($errors)) {
					$file = $editUser->getProfileImage();

					if ($file) {
						if (!$file->replace($imgPost['name'], mime_content_type($imgPost['tmp_name']), file_get_contents($imgPost['tmp_name']))) {
							$errors[] = 'Failed to upload profile image';
						}
					}
					else {
						$file = File::create($imgPost['name'], mime_content_type($imgPost['tmp_name']), file_get_contents($imgPost['tmp_name']));
						if (!$file) {
							$errors[] = 'Failed to upload profile image';
						}
					}

					$newFileId = $file
						? $file->id
						: null;
				}
			}
            
			if(!count($errors)) {
				foreach ($studentData as $key => $val) {
					$profile->$key = $val;
				} //Sets profile values for student

				$editUser->profileImageId = $newFileId;

				/** @var Db */
				$db = $this->get('Db');
				$db->startTransaction();

				if($editUser->save() && $profile->save()) {
					$db->commitTransaction();
					return $this->redirect($editUser->getProfileUrl());
				} //Redirects student to profile page
				else {
					$db->abortTransaction();
					$errors[] = 'Failed to save the profile';
				} //If errors, save error
			}
		}

		return $this->view(['student' => $editUser, 'profile' => $profile, 'errors' => $errors, 'edit' => True]);
	} //If errors, return to edit profile page with errors

	public function ProfileAction($userId = 0) {
		$user = User::getByKey($userId);
		return $this->view(['user' => $user]);
	}

	/**
	 * @CurrentUserMustBeType('student')
	 */
	public function DashboardAction() {
		$studentUser = User::getCurrentUser();

		$classes = InstructorClasses::query(
			"
			SELECT
				ic.*
			FROM
				instructorclasses as ic
			INNER JOIN classes as c ON
				c.class_id = ic.class_id
			WHERE
				c.student_id = :0:
			",
			$studentUser->id
		);

		return $this->view(['user' => $studentUser, 'classes' => $classes]);

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

	/**
	 * @CurrentUserMustBeType('student')
	 */
	public function AllResponsesAction($quiz = '') {
		$currentUser = User::getCurrentUser();

		//TODO: Add paging... this could get big over time
		$quiz = $quiz
			? 1
			: 0;
		$myResponses = FeedbackResponse::query('
			SELECT
				fr.*
			FROM
				feedback_responses as fr
			INNER JOIN feedback_sessions as fs ON
				fs.id = fr.feedback_session_id
			WHERE
				fr.student_id = :0: AND
				fs.is_quiz = :1:
		', $currentUser->id, $quiz);

		return $this->view(compact('myResponses'));
	}

}