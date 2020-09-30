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

            $instructorUserData = [];
            $errors = [];
			foreach($fields as $prop => $postField) {
				if(empty($_POST[$postField])) {
					$errors[] = "{$postField} is required";
				}
				else {
					$instructorUserData[$prop] = $_POST[$postField];
				}
			}
			if(!count($errors)) {
				$instructorUserprofile = InstructorUser::getByKey($currentUser->id);
				if (!$instructorUserprofile) {
					$instructorUserprofile = new InstructorUser();
					$instructorUserprofile->instructorid = $currentUser->id;
				}

				foreach ($instructorUserData as $key => $val) {
					$instructorUserprofile->$key = $val;
				}

				if($instructorUserprofile->save()) {
					return $this->redirect($this->viewHelpers->baseUrl("/User/Profile/{$currentUser->id}"));
				}
				else {
					$errors[] = 'Failed to save the profile';
				}
			}
		}

		return $this->view(['errors' => $errors]);
	}
}
