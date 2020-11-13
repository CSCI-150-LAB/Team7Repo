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
}