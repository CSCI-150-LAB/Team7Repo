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
	 * @Column('file_size')
	 * @var int
	 */
	public $fileSize;

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

	// TODO: It's unlikely but possible for the below code to fail at certain points to delete or rename remote entities. Look into logging these errors
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
		$oldGoogleFileId = $this->googleId;

		// Upload new file
		$newGoogleFileId = $helper->createFile("{$this->id}_new.{$newExt}", $mimeType, $data);

		$this->googleId = $newGoogleFileId;
		$this->name = $name;
		$this->mimeType = $mimeType;
		$this->fileSize = strlen($data);

		if ($this->save()) {
			// Delete old remote file
			if (!$helper->deleteFile($oldGoogleFileId)) {
				$helper->deleteFile($newGoogleFileId);
				$db->abortTransaction();
				return false;
			}

			// Pretty much too far in to abort
			// Rename new remote file
			$helper->renameFile($this->googleId, "{$this->id}.{$newExt}");
			$db->commitTransaction();
			return true;
		}
		else {
			$db->abortTransaction();
		}

		return false;
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
			$record->fileSize = strlen($data);
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