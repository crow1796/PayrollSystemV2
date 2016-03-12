<?php

namespace App\Support\File;
use Storage;
use File;
use Carbon\Carbon;

class FileManager {
	public function uploadFilesToDisk($files = null, $disk = 'imports'){
		if(is_null($files)){
			return false;
		}

		foreach($files as $file){
		    $fileExtension = $file->getClientOriginalExtension();
		    $originalName = trim(trim($file->getClientOriginalName(), '.'.$fileExtension));
		    $filename = Carbon::now()->format('mdY') . '_' . md5($file->getFilename());
		    $filename = $filename . '.' . $fileExtension;
		    Storage::disk($disk)->put($filename, File::get($file));
		}

		return true;
	}

	public function download($files = null){
		if(is_null($files)){
			return false;
		}


	}
}