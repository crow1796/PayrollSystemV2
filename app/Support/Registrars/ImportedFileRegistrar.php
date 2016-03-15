<?php

namespace App\Support\Registrars;

use App\Support\Registrars\Contracts\Registrar;

class ImportedFileRegistrar implements Registrar{

	protected $model;
	protected $data;

	public function createFromModel($model, $data){
		$this->setModelAndData($model, $data);

		return $this->save();
	}

	public function updateFromModel($model, $data){
		$this->setModelAndData($model, $data);

		$this->setLogInformation($data);
		return $this->save();
	}

	public function setModel($model){
		$this->model = $model;
	}

	public function setData($data = array()){
		$this->data = $data;
	}

	public function setModelAndData($model, $data){
		$this->setModel($model);
		$this->setData($data);
	}

	public function save(){
		return $this->model->save();
	}
}