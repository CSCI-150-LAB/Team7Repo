<?php

class UserController extends Controller {
	public function LoginAction() {
		$errors = [];
		
		if ($this->request->isPost()) {
			//Searches for user email and password from database 
			$user = User::findOne('email = :0: AND password = :1:', $_POST['email'], $_POST['password']);

			if ($user) { //Logs in user 
				User::loginUser($user);
				return $this->redirect($user->getProfileUrl());
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
			return $this->redirect($currentUser->getProfileUrl());
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
					return $this->redirect($user->getProfileUrl());
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

	public function ForgotPasswordAction() {
		$emailed = false;
		$errors = [];

		if ($this->request->isPost()) {
			$user = User::findOne('email = :0:', $_POST['email']);
			if ($user) {
				$user->key = hash('sha1', time());

				if ($user->save()) {
					// Render email template
					$viewRenderer = $this->get('ViewRenderer');
					$emailTemplate = $viewRenderer->render([
						APP_ROOT . '/app/emails/ForgotPassword.php' => [
							'user' => $user,
							'resetUrl' => $this->viewHelpers->baseUrl("/User/ResetPassword/{$user->email}/$user->key")
						]
					]);

					mail(
						$user->email,
						'FeedbackLoop - Reset Password',
						$emailTemplate,
						[
							'From' => 'noreply@dandi.dev',
							'Content-type' => 'text/html;charset=UTF-8'
						]
					);
				
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

	public function ResetPasswordAction($email = '', $key = '') {
		$errors = [];
		$reset = false;

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
							$reset = true;
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

			return $this->view(compact('errors', 'reset'));
		}
		else {
			return $this->redirect($this->viewHelpers->baseUrl('/User/Login'));
		}
	}
}
