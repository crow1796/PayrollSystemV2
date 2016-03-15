<?php

namespace App\Support\File\Contract;

interface FileTransferContract {
	public function upload($files = null);
	public function download($filename = null);
	protected function singleUpload($file);
	protected function multipleUpload($files);
}