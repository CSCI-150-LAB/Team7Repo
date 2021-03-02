<?php

/**
 * @Table('files')
 */
class File extends Model {
	/**
	 * @Key
	 * @AutoIncrement
	 * @var int
	 */
	public $id;

	/**
	 * @Column('google_id')
	 * @var string
	 */
	public $googleId;

	public $name;

	/**
	 * @Column('mime_type')
	 */
	public $mimeType;

	/**
	 * @Column('created_at')
	 * @var string
	 */
	public $createdAt;

	public function save() {
		if (is_null($this->createdAt)) {
			$this->createdAt = date('Y-m-d H:i:s');
		}

		return parent::save();
	}

	public function getData() {
		/** @var GoogleApi_Helper */
		$helper = DI::getDefault()->get('googleApiHelper');
		return $helper->getFileDataById($this->googleId);
	}

	/**
	 * Uploads and creates a new file entry
	 *
	 * @param string $name
	 * @param string $data
	 * @return static
	 */
	public static function create($name, $mimeType, $data) {
		/** @var GoogleApi_Helper */
		$helper = DI::getDefault()->get('googleApiHelper');

		try {
			$googleFileId = $helper->createFile($name, $mimeType, $data);

			$record = new self();
			$record->googleId = $googleFileId;
			$record->name = $name;
			$record->mimeType = $mimeType;
			$record->save();

			return $record;
		}
		catch (Exception $e) {
			return null;
		}
	}
}