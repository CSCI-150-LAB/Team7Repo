<?php

class AdminController extends PermsController {
	public function beforeActionHook() {
		$response = $this->CurrentUserMustBeType('admin');
		if ($response) {
			return $response;
		}

		return parent::beforeActionHook();
	}

	/**
	 * @IsAdminUser
	 */
	public function ProfileAction($userId) {
		$user = User::getByKey($userId);
		
		return $this->view(compact('user'));
	}

	/**
	 * @IsAdminUser
	 */
	public function ProfileEditAction($userId) {
		$user = User::getByKey($userId);
		$errors = [];

		if ($this->request->isPost()) {
			// TODO: Do this!
		}

		return $this->view(compact('errors'));
	}
		/**
	 * @IsAdminUser
	 */
	public function PanelAction($userId) {
		$user = User::getByKey($userId);
		
		return $this->view(['users' => $user]);
	}

		/**
	 * @IsAdminUser
	 */
	public function UserAccountsAction() {
		
		$db = $this->get('Db');
		/** @var array[] */
		$useraccounts = $db->query( 
			"
			SELECT * FROM users
			
			"
		);

		
		if ($useraccounts === false) {
			die($db->getLastError());
		}
		/** @var User[] */
		$useraccounts = array_map(['User', 'fromArray'], $useraccounts);
		
		return $this->view(['useraccounts' => $useraccounts]); 
	
	}

	public function AdminAccountsAction() {
		
		$db = $this->get('Db');
		/** @var array[] */
		$adminaccounts = $db->query( 
			"
			SELECT * FROM users
			
			"
		);
		
		if ($adminaccounts === false) {
			die($db->getLastError());
		}
		/** @var User[] */
		$adminaccounts = array_map(['User', 'fromArray'], $adminaccounts);
		
		return $this->view(['adminaccounts' => $adminaccounts]); 
	}

	public function InstructorFeedbackAction() {
		
		$db = $this->get('Db');
		/** @var array[] */
		$feedback = $db->query( 
			"
			SELECT * FROM users
			
			"
		);

		
		if ($feedback === false) {
			die($db->getLastError());
		}
		/** @var User[] */
		$feedback = array_map(['User', 'fromArray'], $feedback);
		
		return $this->view(['feedback' => $feedback]); 
	
	}
	
public function AddUserAction() {
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
			if (HASH_PASSWORDS) {
				$userData['password'] = hash('sha256', $userData['password']);
			}
			$user = User::fromArray($userData);

			
			if ($user->save()) {
				return $this->redirect("Admin/UserAccounts");
			}
			else {
				$errors[] = 'Failed to save the profile';
			}
		}
	}

	return $this->view(['errors' => $errors]);
}

public function StartSessionAction() {
		
	$db = $this->get('Db');
	/** @var array[] */
	$inclasses = $db->query( 
		"
		SELECT class_id, class_title
		FROM instructorclasses
		
		"
	);
	
	if ($inclasses === false) {
		die($db->getLastError());
	}
	/** @var User[] */
	$inclasses = array_map(['User', 'fromArray'], $inclasses);
	
	return $this->view(['inclasses' => $inclasses]); 
}


}
