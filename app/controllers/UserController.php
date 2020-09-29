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

	public function ForgotPasswordAction() {
		$emailed = false;
		$errors = [];

		if ($this->request->isPost()) {
			$user = User::findOne('email = :0:', $_POST['email']);
			if ($user) {
				$user->key = hash('sha256', time());

				if ($user->save()) {
					//TODO: send email to the user
				
					$emailed = true;
				}
				else {
					$errors[] = 'Unable to process your request at this time';
				}
			}
			else {
				$errors[] = 'Email not found';
			}
		}

		return $this->view(compact('emailed', 'errors'));
	}

	public function ResetPasswordAction() {
		$email = empty($_GET['email']) ? '' : $_GET['email'];
		$key = empty($_GET['key']) ? '' : $_GET['key'];
		$errors = [];

		if ($email && $key) {
			$user = User::findOne('email = :0: AND key = :1:', $email, $key);

			if ($user) {
				if ($this->request->isPost()) {
					$fields = [
						'pass',
						'confirm-pass'
					];
		
					$userData = [];
					foreach ($fields as $prop) {
						if (empty($_POST[$prop])) {
							$errors[] = "{$prop} is required";
						}
						else {
							$userData[$prop] = $_POST[$prop];
						}
					}
					
					if ($userData['pass'] !== $userData['confirm-pass']) {
						$errors[] = 'Passwords must match';
					}

					if (!count($errors)) {
						$user->password = hash('sha256', $userData['password']);
						$user->key = null;
						
						if ($user->save()) {
							return $this->redirect($this->viewHelpers->baseUrl('/User/Login'));
						}
						else {
							$errors[] = 'Unable to update user password';
						}
					}
				}
			}
			else {
				$errors[] = 'User reset password request not found';
			}

			return $this->view(compact('errors'));
		}
		else {
			return $this->redirect($this->viewHelpers->baseUrl('/User/Login'));
		}
	}
}
