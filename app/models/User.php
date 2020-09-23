<?php

/**
 * @Table('users')
 */
class User extends Model {
	private static $currentUser = false;

	/**
	 * @Key
	 * @AutoIncrement
	 */
	public $id;

	public $email;

	/**
	 * @Column('first_name')
	 */
	public $firstName;

	/**
	 * @Column('last_name')
	 */
	public $lastName;

	public $password;

	public $activation;

	public $type;

	/**
	 * @Column('updated_at')
	 */
	public $updatedAt;

	/**
	 * @Column('created_at')
	 */
	public $createdAt;

	public static function getCurrentUser() {
		if (self::$currentUser === false) {
			if (isset($_SESSION['current_user'])) {
				self::$currentUser = User::getByKey($_SESSION['current_user']);
			}
			else {
				self::$currentUser = null;
			}
		}

		return self::$currentUser;
	}

	public static function loginUser(User $userModel) {
		if (!$userModel->doesExist()) {
			throw new Exception('User model has not been saved yet');
		}

		self::$currentUser = $userModel;
		$_SESSION['current_user'] = $userModel->id;
	}

	public static function loggoutUser() {
		self::$currentUser = null;
		unset($_SESSION['current_user']);
	}
}