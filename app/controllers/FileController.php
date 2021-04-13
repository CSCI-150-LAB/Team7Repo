<?php

class FileController extends Controller {
	public function LoadAction($fileId) {
		$file = File::getByKey($fileId);
		if (!$file) {
			http_response_code(404);
			return $this->html('');
		}

		$data = $file->getData();
		header('Content-type: ' . $file->mimeType);
		header('Content-length: ' . $file->fileSize);
		return $this->html($data);
	}

	public function DownloadAction($fileId) {
		$file = File::getByKey($fileId);
		if (!$file) {
			http_response_code(404);
			return $this->html('');
		}

		$data = $file->getData();
		header('Content-disposition: attachment; filename=' . $file->name);
		header('Content-type: ' . $file->mimeType);
		header('Content-length: ' . $file->fileSize);
		return $this->html($data);
	}
}