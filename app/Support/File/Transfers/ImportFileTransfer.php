<?php

namespace App\Support\File\Transfers;
use App\Support\File\Transfers\FileTransfer;

class ImportFileTransfer extends FileTransfer{
	protected $disk = 'imports';
}