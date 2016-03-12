<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Eloquent\Repository;
use App\Support\Registrars\EventRegistrar;
use Illuminate\Container\Container as App;

class EventRepository extends Repository{

	protected $eventRegistrar;

	public function __construct(App $app, EventRegistrar $eventRegistrar){
		parent::__construct($app);
		$this->eventRegistrar = $eventRegistrar;
	}

	public function model(){
		return '\App\Event';
	}

	public function create($data = array()){
		return $this->eventRegistrar->createFromModel($this->model, $data);
	}

	public function updateByModel($data = array(), $model){
		return $this->eventRegistrar->updateFromModel($model, $data);
	}
}