<?php

namespace App\Repositories;
use Illuminate\Container\Container as App;

class ListsRepository{
	protected $model;

	public function __construct(App $app){
		$this->app = $app;
	}

	public function lists($className, $value, $key){
		$this->model = $this->app
							->make($className);

		return $this->model
					->lists($value, $key);
	}

	public function listsAsSimpleArray($className, $value, $key){
		return array_flatten($this->lists($className, $value, $key)->toArray());
	}
}