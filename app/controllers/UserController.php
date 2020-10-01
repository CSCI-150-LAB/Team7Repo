<?php

class UserController extends Controller {
	public function LoginAction() {
		$errors = [];
		
		if ($this->request->isPost()) {
			//Searches for user email and password from database 
			$user = User::findOne('email = :0: AND password = :1:', $_POST['email'], $_POST['password']);

			if ($user) { //Logs in user 
				User::loginUser($user);
				return $this->redirect($this->viewHelpers->baseUrl('/Student/Profile/' . $user->id));
			}
			else { //User was not found or email/password was mistyped
				$errors[] = 'Email or password invalid';
			}
		}

		return $this->view(['errors' => $errors]);
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
					$errors[] = "{$postField} is required"; //if user left a input blank
				}
				else {
					$userData[$prop] = $_POST[$postField]; //Assign the credentials submitted by the user to that user
				}
			}

			if (!count($errors)) {
				$userData['createdAt'] = date('Y-m-d H:i:s');
				$user = User::fromArray($userData);

				if ($user->save()) {
					User::loginUser($user);

					return $this->redirect($this->viewHelpers->baseUrl("/Student/Profile/{$user->id}")); 
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
		return $this->redirect($this->viewHelpers->baseUrl('/User/Login')); //Going back to log in page after logout 
	}
}
