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

	
}