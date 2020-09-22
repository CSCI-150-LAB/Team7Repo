<?php

/**
 * @Table('users')
 */
class User extends Model {
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
}