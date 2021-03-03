<?php

/**
 * @Table('adminprofile')
 */
class AdminModel extends Model {

	/**
	 * @Key
	 * @Column('id')
	 */
	public $adminid;

	/**
	 * @Column('type')
	 */
	public $type;


	public function setUserId($userId) {
		$this->instructorid = $userId;
	}
}