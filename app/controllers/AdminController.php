<?php

class AdminController extends PermsController {
	/**
	 * @CurrentUserMustBeType('admin')
	 * @IsAdminUser
	 */
	public function ProfileAction($userId) {
		return $this->view();
	}
}