<?php

namespace App\Support\Excel;
use Maatwebsite\Excel\Files\ExcelFile;

use Request;

class EmployeeDTRListImport extends ExcelFile{

	protected $delimiter = ',';
	protected $enclosure = '"';
	protected $lineEnding = '\r\n';

	public function getFile(){
		$file = Request::input('excel_csv')[0];
		return $file;
	}

	public function getFilters(){
		return [
			'chunk',
		];
	}
}