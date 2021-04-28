<?php

/**
 * @Table('class_files')
 */
class ClassFiles extends Model {
	/**
	 * @Key
	 * @Column('class_id')
	 */
	public $classId;

	/**
	 * @Column('file_id')
	 */
	public $fileId;
}