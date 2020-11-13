<?php

class AdminController extends PermsController {
	/**
	 * @CurrentUserMustBeType('admin')
	 * @IsAdminUser
	 */
	public function ProfileAction($userId) {
		return $this->view();
	}

	public function PanelAction($userId = 0) {
		$user = User::getByKey($userId);
		return $this->view(['user' => $user]);
	}

	public function UserAccountsAction($userId) {
		return $this->view();
	}
}