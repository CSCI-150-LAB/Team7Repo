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
		$user = User::getByKey($userID);
		return $this->view(['user' => $user]);
	}
}