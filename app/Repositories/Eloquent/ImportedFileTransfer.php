<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;

class ImportedFileTransfer extends Repository{
	public function model(){
		return '\App\ImportedFile';
	}
}