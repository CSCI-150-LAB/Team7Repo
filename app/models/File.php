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
	 * @Column('author_id')
	 * @var int
	 */
	public $authorId;

	/**
	 * @Column('updated_at')
	 * @var string
	 */
	public $updatedAt;

	/**
	 * @Column('created_at')
	 * @var string
	 */
	public $createdAt;

	public function getFileType() {
		//TODO: Implement me
		$ext = pathinfo($this->name, PATHINFO_EXTENSION);

		switch ($ext) {
			default:
				return 'Unknown';
		}
	}

	public function getAuthor() {
		return is_null($this->authorId)
			? null
			: User::getByKey($this->authorId);
	}

	public function save() {
		$this->updatedAt = date('Y-m-d H:i:s');

		if (is_null($this->createdAt)) {
			$this->createdAt = $this->updatedAt;
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
	 * @param int|null $authorId
	 * @return static
	 */
	public static function create($name, $mimeType, $data, $authorId = false) {
		if ($authorId === false) {
			if (User::getCurrentUser()) {
				$authorId = User::getCurrentUser()->id;
			}
			else {
				$authorId = null;
			}
		}

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
			$record->authorId = $authorId;
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