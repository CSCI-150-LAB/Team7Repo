<?php

/**
 * @Table('studentprofile')
 */
class StudentModel extends Model {

	/**
	 * @Key
	 * @Column('id')
	 */
	public $studentid;

	/**
	 * @Column('major')
	 */
	public $studentMajor;

	/**
	 * @Column('learning_style')
	 */
	public $learningStyle;

	/**
	 * @Column('visual')
	 */
	public $visual;

	/**
	 * @Column('audio')
	 */
	public $audio;

	/**
	 * @Column('kinesthetic')
	 */
	public $kinesthetic;

	/**
	 * @Column('reading_writing')
	 */
	public $reading_writing;

	/**
	 * @Column('visual_tool')
	 */
	public $visual_tool;

	/**
	 * @Column('audio_tool')
	 */
	public $audio_tool;

	/**
	 * @Column('kinesthetic_tool')
	 */
	public $kinesthetic_tool;

	/**
	 * @Column('read_write_tool')
	 */
	public $read_write_tool;

	public function setUserId($userId) {
		$this->studentid = $userId;
	}
}