<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;
use Illuminate\Container\Container as App;
use App\Repositories\Eloquent\ContactInformationRepository;
use App\Repositories\Eloquent\AdditionalInformationRepository;
use App\Support\Registrars\EmployeeRegistrar;

class EmployeeRepository extends Repository{

	protected $contactInformationRepository;
	protected $additionalInformationRepository;
	protected $employeeRegistrar; 

	public function __construct(App $app, 
			ContactInformationRepository $contactInformationRepository,AdditionalInformationRepository $additionalInformationRepository,
				EmployeeRegistrar $employeeRegistrar){
		parent::__construct($app);
		$this->contactInformationRepository = $contactInformationRepository;
		$this->additionalInformationRepository = $additionalInformationRepository;
		$this->employeeRegistrar = $employeeRegistrar;
	}

	public function model(){
		return '\App\Employee';
	}

	public function create($data = array()){
		return $this->employeeRegistrar->createFromModel($this->model, $data);
	}

	public function updateByModel($data = array(), $model){
		return $this->employeeRegistrar->updateFromModel($model, $data);
	}
}
