<?php

namespace App\Support\Registrars;

use App\Support\Registrars\Contracts\Registrar;
use Hash;

class DailyRecordRegistrar implements Registrar{

	protected $model;
	protected $data;

	public function createFromModel($model, $data){
		$this->setModelAndData($model, $data);

		$this->setDailyRecord();

		return $this->save();
	}

	public function updateFromModel($model, $data){
		$this->setModelAndData($model, $data);

		$this->setDailyRecord();

		return $this->save();
	}

	public function save(){
		return $this->model->save();
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

	public function setDailyRecord(){
		$this->model->employee_id = $this->data['employee_id'];
		$this->model->time_in = $this->data['time_in'];
		$this->model->time_out = $this->data['time_out'];
		$this->model->record_date = $this->data['record_date'];
	}
}