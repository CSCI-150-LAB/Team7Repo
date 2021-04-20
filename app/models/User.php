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
	 * @Column('preferred_title')
	 */
	public $preferredTitle;

	/**
	 * @Column('profile_image_id')
	 */
	public $profileImageId;

	/**
	 * @Column('first_name')
	 */
	public $firstName;

	/**
	 * @Column('last_name')
	 */
	public $lastName;

	public $password;

	/**
	 * @Column('password_salt')
	 */
	public $passwordSalt;

	/**
	 * @Column('activation')
	 */
	public $key;

	public $type;

	/**
	 * @Column('auth_token')
	 */
	public $authToken;

	/**
	 * @Column('auth_token_date')
	 */
	public $authTokenExpirationDate;

	/**
	 * @Column('updated_at')
	 */
	public $updatedAt;

	/**
	 * @Column('created_at')
	 */
	public $createdAt;

	/**
	 * Concatenates the full name
	 *
	 * @return string
	 */
	public function getFullName($withTitle = false) {
		return trim(($withTitle ? $this->preferredTitle : '') . ' ' . $this->firstName . ' ' . $this->lastName);
	}

	/**
	 * Retrieves the profile db model for the user type
	 *
	 * @return InstructorModel|StudentModel
	 */
	public function getProfileModel() {
		$class = ucfirst($this->type) . 'Model';

		$model = $class::getByKey($this->id);
		if (!$model) {
			$model = new $class();
			$model->setUserId($this->id);
			$model->save();
		}

		return $model;
	}

	protected function getUserTypeController() {
		return ucfirst($this->type);
	}

	/**
	 * Returns the absolute url to this user's profile page
	 *
	 * @return string
	 */
	public function getProfileUrl() {
		$viewHelpers = DI::getDefault()->get('IViewHelpers');
		return $viewHelpers->baseUrl("{$this->getUserTypeController()}/Profile/{$this->id}");
	}

	/**
	 * Returns the absolute url to this user's dashboard page
	 *
	 * @return string
	 */
	public function getDashboardUrl() {
		$viewHelpers = DI::getDefault()->get('IViewHelpers');
		return $viewHelpers->baseUrl("{$this->getUserTypeController()}/Dashboard");
	}

	/**
	 * Returns whether the user is the logged in user
	 *
	 * @return boolean
	 */
	public function isLoggedIn() {
		return (isset($_SESSION['current_user']) && $this->doesExist() && ($this->id == $_SESSION['current_user']));
	}

	/**
	 * Returns whether the user is an admin
	 *
	 * @return boolean
	 */
	public function isAdmin() {
		return $this->type == 'admin';
	}

	/**
	 * Returns whether the user is an instructor
	 *
	 * @return boolean
	 */
	public function isInstructor() {
		return $this->type == 'instructor';
	}

	/**
	 * Returns whether the user is a student
	 *
	 * @return boolean
	 */
	public function isStudent() {
		return $this->type == 'student';
	}

	/**
	 * Fetches the current logged in user
	 *
	 * @return User|null
	 */
	public static function getCurrentUser() {
		if (self::$currentUser === false) { 
			if (isset($_SESSION['current_user'])) { //If a user is in session? 
				self::$currentUser = User::getByKey($_SESSION['current_user']); //Then assign user to current user? 
			}
			else {
				self::$currentUser = null; //There is no current user 
			}
		}

		return self::$currentUser;
	}

	/**
	 * Logs in the given user
	 *
	 * @param User $userModel
	 * @return void
	 */
	public static function loginUser(User $userModel) {
		if (!$userModel->doesExist()) {
			throw new Exception('User model has not been saved yet');
		}

		self::$currentUser = $userModel;
		$_SESSION['current_user'] = $userModel->id; 
	}

	/**
	 * Logs out the current user
	 *
	 * @return void
	 */
	public static function loggoutUser() {
		self::$currentUser = null;
		unset($_SESSION['current_user']);
	}

	/**
	 * Get's an auth token for the current user
	 *
	 * @return string
	 */
	public function getAuthToken() {
		if (is_null($this->authTokenExpirationDate) || $this->authTokenExpirationDate < time()) {
			$this->authToken = sha1(rand());
			$this->authTokenExpirationDate = strtotime('+1 day');
			$this->save();
		}

		return $this->authToken;
	}

	/**
	 * Fetches the referenced File model
	 * 
	 * @return null|File 
	 */
	public function getProfileImage() {
		return is_null($this->profileImageId)
			? null
			: File::getByKey($this->profileImageId);
	}

	/**
	 * Generates an image href for the profile image
	 * 
	 * @return string 
	 */
	public function getProfileImageSrc() {
		/** @var ViewHelpers */
		$viewHelpers = DI::getDefault()->get('IViewHelpers');

		return is_null($this->profileImageId)
			? $viewHelpers->publicUrl('images/blank_avatar.png')
			: $viewHelpers->baseUrl("/File/Load/{$this->profileImageId}");
	}

	protected function getProp($prop) {
		if ($prop == 'authTokenExpirationDate' && !is_string($this->$prop)) {
			return date('Y-m-d H:i:s', $this->$prop);
		}

		return parent::getProp($prop);
	}

	protected function setProp($prop, $value) {
		if ($prop == 'authTokenExpirationDate') {
			if (is_string($value)) {
				$this->$prop = strtotime($value) ?: 0;
			}
			else {
				$this->$prop = $value ?: 0;
			}
		}
		else {
			parent::setProp($prop, $value);
		}
	}
}