<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;
use Illuminate\Container\Container as App;
use App\Support\Registrars\LogRegistrar;

class LogRepository extends Repository{

	protected $logRegistrar;

	public function __construct(App $app, LogRegistrar $logRegistrar){
		parent::__construct($app);
		$this->logRegistrar = $logRegistrar;
	}

	public function model(){
		return '\App\Log';
	}

	public function create($data = array()){
		return $this->logRegistrar->createFromModel($this->model, $data);
	}

	public function updateByModel($model, $data){
		return $this->logRegistrar->updateFromModel($this->model, $data);
	}
}