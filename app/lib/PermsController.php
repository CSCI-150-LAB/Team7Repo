<?php

class PermsController extends Controller implements IControllerHooks {
	public function beforeActionHook() {
		// Admins can do what they want
		$currentUser = User::getCurrentUser();
		if ($currentUser && $currentUser->type == 'admin') {
			return;
		}

		$actionMethod = $this->request->getActionName() . 'Action';
		$annotations = static::getAnnotations();
		$annotations = $annotations['methods'][$actionMethod]['calls'];

		foreach ($annotations as $call) {
			$fn = $call['func'];
			$result = $this->$fn(...$call['args']);

			if ($result instanceof IResponse) {
				return $result;
			}
		}
	}

	public function afterActionHook(IResponse $response) {
		// Not used
	} 

	protected function MustBeLoggedIn($route = '/Index/NotAuthenticated') {
		if (!User::getCurrentUser()) {
			return $this->forward($route);
		}
	}

	protected function MustNotBeLoggedIn() {
		if ($currentUser = User::getCurrentUser()) {
			return $this->redirect($currentUser->getProfileUrl());
		}
	}

	protected function UserMustExist($paramNumber = 0) {
		$params = $this->request->getRouteParams();
		if (!isset($params[$paramNumber])) {
			return;
		}

		$paramUserId = $params[$paramNumber];
		$user = User::getByKey($paramUserId);

		if (!$user) {
			return $this->forward('/Index/InvalidParams');
		}
	}

	protected function IsCurrentUser($paramNumber = 0) {
		$user = User::getCurrentUser();
		if (!$user) {
			return;
		}

		$params = $this->request->getRouteParams();
		if (!isset($params[$paramNumber])) {
			return;
		}

		$paramUserId = $params[$paramNumber];
		if ($user->id != $paramUserId) {
			return $this->forward('/Index/PermissionDenied');
		}
	}

	protected function IsUserType($paramNumber, $type) {
		$params = $this->request->getRouteParams();
		if (!isset($params[$paramNumber])) {
			return;
		}

		$paramUserId = $params[$paramNumber];
		$user = User::getByKey($paramUserId);

		if (!$user || $user->type != $type) {
			return $this->forward("/Index/InvalidUserType/{$type}");
		}
	}

	protected function IsStudentUser($paramNumber = 0) {
		return $this->IsUserType($paramNumber, 'student');
	}

	protected function IsInstructorUser($paramNumber = 0) {
		return $this->IsUserType($paramNumber, 'instructor');
	}

	protected function IsAdminUser($paramNumber = 0) {
		return $this->IsUserType($paramNumber, 'admin');
	}

	protected function CurrentUserMustBeType($type) {
		$user = User::getCurrentUser();
		if (!$user || $user->type != $type) {
			return $this->forward('/Index/PermissionDenied');
		}
	}
}