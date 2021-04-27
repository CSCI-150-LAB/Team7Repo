<?php

/**
 * @Table('files')
 */
class File extends Model {
	const FILE_SIZE_ABBREVIATIONS = ['bytes', 'kb', 'mb', 'gb', 'tb'];

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
	 * @Column('file_size')
	 * @var int
	 */
	public $fileSize;

	/**
	 * @Column('created_at')
	 * @var string
	 */
	public $createdAt;

		/**
	 * @Column('class_id')
	 * @var int
	 */
	public $classid;



	public function getFileInfo() {
		return is_null($this->classid)
			? null
			: File::getByKey($this->classid);
	}

	public function save() {
		if (is_null($this->createdAt)) {
			$this->createdAt = date('Y-m-d H:i:s');
		}

		return parent::save();
	}

	public function delete() {
		if (parent::delete()) {
			/** @var Db */
			$db = DI::getDefault()->get(Db::class);
			$db->trackModel(DbTrackTypeEnum::COMMITTED(), function() {
				/** @var GoogleApi_Helper */
				$helper = DI::getDefault()->get('googleApiHelper');
				$helper->deleteFile($this->googleId);
			});

			return true;
		}
		
		return false;
	}

	public function getFileSizeString($decimals = 1) {
		$ndx = floor(log($this->fileSize, 1024));
		$number = round($this->fileSize / pow(1024, $ndx), $decimals);
		$unit = self::FILE_SIZE_ABBREVIATIONS[$ndx];

		return "{$number} {$unit}";
	}

	/**
	 * Replaces current file entities data with given arguments. Performs a save and returns the result.
	 *
	 * @param string $name
	 * @param string $mimeType
	 * @param string $data
	 * @return bool
	 */
	public function replace($name, $mimeType, $data) {
		/** @var Db */
		$db = DI::getDefault()->get(Db::class);
		$db->startTransaction();
		/** @var GoogleApi_Helper */
		$helper = DI::getDefault()->get('googleApiHelper');
		$newExt = pathinfo($name, PATHINFO_EXTENSION);

		$this->name = $name;
		$this->mimeType = $mimeType;
		$this->fileSize = strlen($data);

		if ($this->save() && $helper->replaceFile($this->googleId, "{$this->id}.{$newExt}", $mimeType, $data)) {
			$db->commitTransaction();
			return true;
		}
		else {
			$db->abortTransaction();
			return false;
		}
	}

	/**
	 * Retreives byte data as a string
	 *
	 * @return string
	 */
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
	public static function create($name, $mimeType, $data, $class_id=NULL) {
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
			$record->fileSize = strlen($data);
			$record->classid = $class_id;
			$record->save();

			$ext = pathinfo($name, PATHINFO_EXTENSION);
			$googleFileId = $helper->createFile("{$record->id}.{$ext}", $mimeType, $data);

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