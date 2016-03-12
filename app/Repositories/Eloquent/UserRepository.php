<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;
use Illuminate\Container\Container as App;
use App\Support\Registrars\UserRegistrar;

class UserRepository extends Repository{

	protected $userRegistrar;

	public function __construct(App $app, UserRegistrar $userRegistrar){
		parent::__construct($app);
		$this->userRegistrar = $userRegistrar;
	}

	public function model(){
		return '\App\User';
	}

	public function create($data = array()){
		return $this->userRegistrar->createFromModel($this->model, $data);
	}

	public function updateByModel($data = array(), $model){
		return $this->userRegistrar->updateFromModel($model, $data);
	}
}