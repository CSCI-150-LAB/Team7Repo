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

		/** @var Db */
		$db = DI::getDefault()->get('Db');
		$db->startTransaction();

		try {
			$record = new self();
			$record->googleId = 'temp';
			$record->name = $name;
			$record->mimeType = $mimeType;
			$record->save();

			$info = pathinfo($name);
			$googleFileId = $helper->createFile("{$record->id}.{$info['extension']}", $mimeType, $data);

			if (is_null($googleFileId)) {
				throw new Exception("Failed to create file");
			}

			$record->googleId = $googleFileId;
			$record->save();

			$db->commitTransaction();

			return $record;
		}
		catch (Exception $e) {
			$db->abortTransaction();
			return null;
		}
	}
}