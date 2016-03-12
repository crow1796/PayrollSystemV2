<?php

namespace App\Support\Registrars;

use App\Support\Registrars\Contracts\Registrar;
use Hash;

class UserRegistrar implements Registrar{

	protected $model;
	protected $data;

	public function createFromModel($model, $data){
		$this->setModelAndData($model, $data);

		$this->setUserInformation();

		return $this->save();
	}

	public function updateFromModel($model, $data){
		$this->setModelAndData($model, $data);

		$this->setUserInformation();

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

	public function setUserInformation(){
		if(isset($this->data['username'])){
			$employee = \App\Employee::findOrFail($this->data['username']);
			$this->model->employmentInformation()->associate($employee);
		}
		$permission = \App\Permission::findOrFail($this->data['permission_type']);

		$this->model->password = bcrypt($this->data['password']);
		if(isset($employee->first_name)){
			$this->model->first_name = $employee->first_name;
		}
		if(isset($employee->middle_name)){
			$this->model->middle_name = $employee->middle_name;
		}
		if(isset($employee->last_name)){
			$this->model->last_name = $employee->last_name;
		}
		if(isset($employee->email)){
			$this->model->email = $employee->email;
		}
		$this->model->permission()->associate($permission);
	}
}