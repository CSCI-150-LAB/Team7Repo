<?php

class InstructorController extends Controller {

	public function EditProfileAction() {
        $currentUser = User::getCurrentUser();

		if($this->request->isPost()) {
			$fields = [
				'department' => 'department',
				'name' => 'name',
				'visual' => 'visual',
				'auditory' => 'auditory',
                'readwrite' => 'readwrite',
                'kines' => 'kines'
			];

			$userData = [];
			foreach($fields as $prop => $postField) {
				if(empty($_POST[$postField])) {
					$errors[] = "{$postField} is required";
				}
				else {
					$userData[$prop] = $_POST[$postField];
				}
			}

			if (!count($errors)) {
				$userprofile = InstructorUser::fromArray($userData);
                $userData['instructorid'] = $currentUser;
				if ($userprofile->save()) {
					return $this->redirect($this->viewHelpers->baseUrl("/User/Profile/{$userprofile->instructorid}"));
				}
				else {
					$errors[] = 'Failed to save the profile';
				}
			}
		}

		return $this->view(['errors' => $errors]);
	}

	public function ProfileAction($userId = 0) {
		$user = User::getByKey($userId);

		return $this->view(['user' => $user]);
	}
}
