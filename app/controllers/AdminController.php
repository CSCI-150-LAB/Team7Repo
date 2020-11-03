<?php

class AdminController extends PermsController {
	/**
	 * @CurrentUserMustBeType('admin')
	 * @IsAdminUser
	 */

	public function ProfileAction($userId = 0) { 
		$user = User::getByKey($userId);
		return $this->view(['user' => $user]);
	}
}