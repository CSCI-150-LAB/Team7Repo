<?php

class GoogleApi_Helper {
	private $client;
	private $ready = true;
	private $errorLevel;

	public function __construct($clientId, $clientSecret, $redirectUrl) {
		$this->errorLevel = error_reporting();

		$this->client = new Google_Client();
		$this->client->setApplicationName($_ENV['googleAppName']);
		$this->client->setScopes(Google_Service_Drive::DRIVE);
		$this->client->setClientId($clientId);
		$this->client->setClientSecret($clientSecret);
		$this->client->setRedirectUri($redirectUrl);
		$this->client->setAccessType('offline');
		$this->client->setPrompt('select_account consent');

		$accessToken = Options::getOption('googleAccessToken');
		if (!is_null($accessToken)) {
			$this->client->setAccessToken($accessToken);
		}

		$this->toggleErrorLevels(true);
		
		if ($this->client->isAccessTokenExpired()) {
			$this->ready = false;

			if ($this->client->getRefreshToken()) {
				$this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());

				Options::setOption('googleAccessToken', $this->client->getAccessToken());
				$this->ready = true;
			}
		}

		$this->toggleErrorLevels();
	}

	protected function toggleErrorLevels($warningsOff = false) {
		if ($warningsOff) {
			error_reporting($this->errorLevel ^ E_WARNING);
		}
		else {
			error_reporting($this->errorLevel);
		}
	}

	public function getAuthUrl() {
		return $this->client->createAuthUrl();
	}

	public function generateAccessToken($verificationCode) {
		// Exchange authorization code for an access token.
		$accessToken = $this->client->fetchAccessTokenWithAuthCode($verificationCode);

		// Check to see if there was an error.
		if (array_key_exists('error', $accessToken)) {
			throw new Exception(join(', ', $accessToken));
		}

		Options::setOption('googleAccessToken', $accessToken);
		$this->client->setAccessToken($accessToken);
	}

	public function isReady() {
		return $this->ready;
	}

	/**
	 * Retrieves a file from Google Drive by id
	 *
	 * @param string $googleFileId
	 * @return Google_Service_Drive_DriveFile
	 */
	public function getFileMetaById($googleFileId) {
		$this->toggleErrorLevels(true);

		try {
			$service = new Google_Service_Drive($this->client);

			return $service->files->get($googleFileId);
		}
		finally {
			$this->toggleErrorLevels();
		}
	}

	/**
	 * Retrieves the file data from Google Drive by id
	 *
	 * @param string $googleFileId
	 * @return string
	 */
	public function getFileDataById($googleFileId) {
		$this->toggleErrorLevels(true);

		try {
			$service = new Google_Service_Drive($this->client);

			/** @var \GuzzleHttp\Psr7\Response */
			$stream = $service->files->get($googleFileId, ['alt' => 'media']);
	
			return $stream->getBody()->__toString();
		}
		catch (Exception $e) {
			return null;
		}
		finally {
			$this->toggleErrorLevels();
		}
	}

	public function createFile($name, $mimeType, $data) {
		$this->toggleErrorLevels(true);

		try {
			$service = new Google_Service_Drive($this->client);

			$fileMetadata = new Google_Service_Drive_DriveFile([
				'name' => $name
			]);

			$file = $service->files->create($fileMetadata, [
				'data' => $data,
				'mimeType' => $mimeType,
				'fields' => 'id'
			]);

			return $file->getId();
		}
		catch (Exception $e) {
			return null;
		}
		finally {
			$this->toggleErrorLevels();
		}
	}

	/**
	 * Returns an array of all files in the drive. Mostly for testing
	 *
	 * @return Google_Service_Drive_DriveFile[]
	 */
	public function getFileList() {
		$this->toggleErrorLevels(true);

		try {
			$service = new Google_Service_Drive($this->client);

			$optParams = array(
				'pageSize' => 10,
				'fields' => 'nextPageToken, files(id, name)'
			);

			$results = $service->files->listFiles($optParams);
			return $results->getFiles();
		}
		finally {
			$this->toggleErrorLevels();
		}
	}
}