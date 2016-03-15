<?php

namespace App\Support\File;
use Storage;
use File;
use Carbon\Carbon;
use App\Support\File\Contract\FileTransferContract;
use App\Repositories\Contracts\RepositoryInterface;

class FileTransfer implements FileTransferContract{
	protected $disk;
	protected $fileRepository;

	public function __construct(RepositoryInterface $fileRepository){
		$this->fileRepository = $fileRepository;
	}

	public function upload($files = null){
		if(is_null($files)){
			return false;
		}

		if(!is_array($files)){
			return $this->moveSingleFile($file, $disk);
		}

		$this->moveFilesInArray($files, $disk);
	}

	protected function singleUpload($file){
		$this->transferFile($file);
	}

	protected function multipleUpload($files){
		foreach($files as $file){
		    $this->transferFile($file);
		}
	}

	protected function transferFile($file){
		$fileExtension = $file->getClientOriginalExtension();
		$originalName = trim(trim($file->getClientOriginalName(), '.'.$fileExtension));
		$filename = Carbon::now()->format('mdY') . '_' . md5($file->getFilename());
		$filename = $filename . '.' . $fileExtension;
		Storage::disk($this->disk)->put($filename, File::get($file));
	}

	public function download($filename = null){
		if(is_null($files)){
			return false;
		}
	}
}