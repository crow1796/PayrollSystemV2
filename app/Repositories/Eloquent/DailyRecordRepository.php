<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;
use Illuminate\Container\Container as App;
use App\Support\Registrars\DailyRecordRegistrar;

class DailyRecordRepository extends Repository{

	protected $dtrRegistrar;

	public function __construct(App $app, DailyRecordRegistrar $dtrRegistrar){
		parent::__construct($app);
		$this->dtrRegistrar = $dtrRegistrar;
	}

	public function model(){
		return '\App\DailyRecord';
	}

	public function create($data = array()){
        $data['record_date'] = \Carbon\Carbon::parse($data['record_date'])->format('Y-m-d');
        $dailyRecord = $this->model->where('employee_id', $data['employee_id'])
        							->where('record_date', $data['record_date'])
        							->get();
        if($dailyRecord->count() > 0){
        	return $this->dtrRegistrar->updateFromModel($dailyRecord[0], $data);
        }
    	return $this->dtrRegistrar->createFromModel($this->model, $data);
	}
}