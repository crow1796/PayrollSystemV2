<?php

namespace App\Support\Registrars;

use App\Support\Registrars\Contracts\Registrar;

class EventRegistrar implements Registrar{

	protected $model;
	protected $data;

	public function createFromModel($model, $data){
		$this->setModelAndData($model, $data);

		$this->setEventInformation($data);
		return $this->save();
	}

	public function updateFromModel($model, $data){
		$this->setModelAndData($model, $data);

		$this->setEventInformation($data);
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

	private function setEventInformation($data){
		$this->model->title = $data['event_name'];
		$this->model->location = $data['event_location'];
		if(isset($data['all_day'])){
			$this->model->allDay = $data['all_day'];
		}
		$this->model->start = $this->parseDateTime($data['event_start_date'], $data['event_start_time']);
		$this->model->end = $this->parseDateTime($data['event_end_date'], $data['event_end_time']);
		$this->model->description = $this->checkDescription($data);
		$eventType = \App\EventType::find($data['event_type']);
		$this->model->eventType()->associate($eventType);
		$this->model->className = $eventType->class_value;

		return $this;
	}

	private function checkDescription($data){
		if(!$data['event_description']){
			return $data['event_name'] . ' ' . \Carbon\Carbon::parse($data['event_start_date'])->format('Y');
		}
		return $data['event_description'];
	}

	private function parseDateTime($date, $time){
		return \Carbon\Carbon::parse($date . ' ' . $time);
	}

	public function save(){
		$this->model->save();
	}
}