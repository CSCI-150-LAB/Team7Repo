<?php

class InstructorController extends Controller {

	public function InstructorProfileEditAction() {
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
					$instructorUserData[$prop] = $_POST[$postField];
				}
			}

			if(!count($errors)) {
                $instructorUserData['instructorid'] = $currentUser;
				$instructorUserprofile = InstructorUser::fromArray($instructorUserData);
				if($instructorUserprofile->save()) {
					return $this->redirect($this->viewHelpers->baseUrl("/User/Profile/{$instructorUserprofile->instructorid}"));
				}
				else {
					$errors[] = 'Failed to save the profile';
				}
			}
		}

		return $this->view(['errors' => $errors]);
	}
}
