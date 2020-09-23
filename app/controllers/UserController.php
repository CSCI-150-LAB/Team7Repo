<?php

class UserController extends Controller {
	public function LoginAction() {
		// Process result from queries

		return $this->view(['result' => 42]);
	}

	public function RegisterAction() {
		$currentUser = User::getCurrentUser();
		if ($currentUser) {
			return $this->redirect($this->viewHelpers->baseUrl("/User/Profile/{$currentUser->id}"));
		}
		
		$errors = [];

		if ($this->request->isPost()) {
			$fields = [
				'email' => 'email',
				'firstName' => 'first',
				'lastName' => 'last',
				'password' => 'pass',
				'type' => 'role'
			];

			$userData = [];
			foreach ($fields as $prop => $postField) {
				if (empty($_POST[$postField])) {
					$errors[] = "{$postField} is required";
				}
				else {
					$userData[$prop] = $_POST[$postField];
				}
			}

			if (!count($errors)) {
				$userData['createdAt'] = date('Y-m-d H:i:s');
				$user = User::fromArray($userData);

				if ($user->save()) {
					User::loginUser($user);

					return $this->redirect($this->viewHelpers->baseUrl("/User/Profile/{$user->id}"));
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

	public function LogoutAction() {
		User::loggoutUser();
		return $this->redirect($this->viewHelpers->baseUrl('/User/Login'));
	}
}
