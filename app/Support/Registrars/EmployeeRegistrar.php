<?php

namespace App\Support\Registrars;

use App\Repositories\Eloquent\ContactInformationRepository;
use App\Repositories\Eloquent\AdditionalInformationRepository;
use App\Support\Registrars\Contracts\Registrar;

class EmployeeRegistrar implements Registrar{

	protected $model;
	protected $data;
	protected $contactInformationRepository;
	protected $additionalInformationRepository;
	protected $contactInformation;
	protected $additionalInformation;

	public function __construct(ContactInformationRepository $contactInformationRepository, AdditionalInformationRepository $additionalInformationRepository){
		$this->contactInformationRepository = $contactInformationRepository;
		$this->additionalInformationRepository = $additionalInformationRepository;
	}

	/**
	 * Insert new record based on parameters passed.
	 * @param  Model $model 
	 * @param  array $data  
	 * @return mixed        
	 */
	public function createFromModel($model, $data){
		$this->setModelAndData($model, $data);

		$this->setEmployeeBasicInformation($data);

		$this->contactInformation = $this->setContactInformation($data);
		$this->additionalInformation = $this->setAdditionalInformation($data);
		
		return $this->save($data);
	}

	/**
	 * Update existing record based on parameters passed.
	 * @param  Model $model 
	 * @param  array $data  
	 * @return mixed        
	 */
	public function updateFromModel($model, $data){
		$this->setModelAndData($model, $data);

		$this->setEmployeeBasicInformation($data);

		$this->contactInformation = $this->setContactInformation($data);
		$this->additionalInformation = $this->setAdditionalInformation($data);
		
		return $this->save($data);
	}

	/**
	 * Set local variable, model.
	 * @param Model $model 
	 */
	public function setModel($model){
		$this->model = $model;
	}

	/**
	 * Set local variable, data.
	 * @param array $data 
	 */
	public function setData($data = array()){
		$this->data = $data;
	}

	/**
	 * Set local variables, model and data.
	 * @param Model $model 
	 * @param array $data  
	 */
	public function setModelAndData($model, $data){
		$this->setModel($model);
		$this->setData($data);
	}

	/**
	 * Set employee benefits.
	 * @param array $data 
	 */
	private function setEmployeeBenefits($data){
		if(isset($data['employee_id'])){
			$this->model = \App\Employee::findOrFail($data['employee_id']);
		}
		$benefits = array_flatten(\App\Benefit::all('id')->toArray());
		$counter = 0;

		$this->model->benefits()->sync($benefits);

		for($i = 0; $i < count($benefits); $i++, $counter++){
			$this->model->benefits[$i]->pivot->benefit_id_value = $data['benefits'][$i];
			$this->model->benefits[$i]->pivot->save();
		}

		$this->model->save();
		return $counter > 0;
	}

	public function setEmployeeExpenses($data){
		if(isset($data['employee_id'])){
			$this->model = \App\Employee::findOrFail($data['employee_id']);
		}
		$expenses = array_flatten(\App\Expenses::all('id')->toArray());
		$counter = 0;

		$this->model->expenses()->sync($expenses);

		for($i = 0; $i < count($expenses); $i++, $counter++){
			$this->model->expenses[$i]->pivot->deduction = isset($data['expenses']) ? $data['expenses'][$i] : 0;
			$this->model->expenses[$i]->pivot->save();
		}

		$this->model->save();
		return $counter > 0;
	}

	public function setEmployeeInvestments($data){
		if(isset($data['employee_id'])){
			$this->model = \App\Employee::findOrFail($data['employee_id']);
		}
		$investments = array_flatten(\App\Investment::all('id')->toArray());
		$counter = 0;

		$this->model->investments()->sync($investments);

		for($i = 0; $i < count($investments); $i++, $counter++){
			$this->model->investments[$i]->pivot->deduction = isset($data['investments']) ? $data['investments'][$i] : 0;
			$this->model->investments[$i]->pivot->save();
		}

		$this->model->save();
		return $counter > 0;
	}

	/**
	 * Set employee's basic information.
	 * @param array $data 
	 */
	private function setEmployeeBasicInformation($data){
		if(isset($data['employee_id'])){
			$this->model->id = $data['employee_id'];
		}
		$this->model->date_employed = \Carbon\Carbon::parse($data['date_employed'])->toDateString();
		$this->model->first_name = $data['first_name'];
		$this->model->middle_name = $data['middle_name'];
		$this->model->last_name = $data['last_name'];
		$this->model->suffix = $data['name_suffix'];
		$this->model->email = $data['email'];
		$this->model->active = true;

		$position = \App\Position::findOrFail($data['position']);
		$designation = \App\Designation::findOrFail($data['designation']);
		$department = \App\Department::findOrFail($data['department']);
		$businessUnit = \App\BusinessUnit::findOrFail($data['business_unit']);

		$this->model->position()->associate($position);
		$this->model->designation()->associate($designation);
		$this->model->department()->associate($department);
		$this->model->businessUnit()->associate($businessUnit);

		$this->model->street = $data['street'];
		$this->model->city = $data['city'];
		$this->model->province = $data['province'];
		$this->model->zipcode = $data['zipcode'];
	}

	/**
	 * Set employee's contact information.
	 * @param array $data 
	 */
	private function setContactInformation($data){
		$contactInformation = !is_null($this->model->contactInformation) ? $this->model->contactInformation : new \App\ContactInformation;

		$contactInformation->mobile_number = $data['mobile_number'];
		$contactInformation->telephone_number = $data['telephone_number'];
		$contactInformation->emergency_name = $data['emergency_name'];
		$contactInformation->emergency_number = $data['emergency_number'];

		$contactInformation->employee()->associate($this->model);

		return $contactInformation;
	}

	/**
	 * Set employee's additional information
	 * @param [type] $data [description]
	 */
	private function setAdditionalInformation($data){
		$additionalInformation = !is_null($this->model->additionalInformation) ? $this->model->additionalInformation : new \App\AdditionalInformation;

		$additionalInformation->date_of_birth = \Carbon\Carbon::parse($data['dob'])->toDateString();
		$additionalInformation->place_of_birth = $data['birthplace'];
		$additionalInformation->height = $data['height'];
		$additionalInformation->weight = $data['weight'];
		$additionalInformation->religion = $data['religion'];
		$additionalInformation->civil_status = $data['civil_status'];
		if(strtolower($data['civil_status']) == 'married'){
			$additionalInformation->name_of_spouse = $data['spouse_name'];
			$additionalInformation->number_of_children = $data['number_of_children'];
		}
		$additionalInformation->gender = $data['gender'];
		$additionalInformation->educational_attainment = $data['educational_attainment'];
		$additionalInformation->course = $data['course'];
		$additionalInformation->mother_name = $data['mother_name'];
		$additionalInformation->father_name = $data['father_name'];

		$file = $data['display_photo'];
		$fileExtension = $file->getClientOriginalExtension();
		$originalName = trim(trim($file->getClientOriginalName(), '.'.$fileExtension));
		$filename = \Carbon\Carbon::now()->format('mdY') . '_' . md5($file->getFilename());
		$filename = $filename . '.' . $fileExtension;
		\File::move($file, public_path('uploads/images/' . $filename));
		$additionalInformation->display_photo = 'uploads/images/' . $filename;

		$additionalInformation->employee()->associate($this->model);

		return $additionalInformation;
	}

	/**
	 * Persist model.
	 * @param  array $data 
	 * @return mixed       
	 */
	public function save($data){
		$this->model->save();
		$this->contactInformation->save();
		$this->additionalInformation->save();

		$this->setEmployeeBenefits($data);
		$this->setEmployeeExpenses($data);
		$this->setEmployeeInvestments($data);
		return $this->model->save();
	}

	public function updateRates($employee, $data){
		unset($data['_method']);
		unset($data['_token']);
		if($employee->rates->count() > 0){
			$rates = $employee->rates[0];
			foreach($this->rateKeys() as $key){
				$rates->{$key} = $data[$key];
			}
			return $rates->save();
		}
		$rates = new \App\Rate;
		$data['rateable_id'] = $employee->id;
		$data['rateable_type'] = 'App\Employee';
		foreach($this->rateKeys() as $key){
			$rates->{$key} = $data[$key];
		}
		return $employee->rates()->save($rates);
	}

	public function rateKeys(){
	    return [
	            'regular',
	            'regular_ot',
	            'regular_nd',
	            'regular_nd_ot',
	            'sun',
	            'sun_ot',
	            'sun_nd',
	            'sun_nd_ot',
	            'spl_holiday',
	            'spl_holiday_ot',
	            'spl_holiday_nd',
	            'spl_holiday_nd_ot',
	            'legal_holiday',
	            'legal_holiday_ot',
	            'legal_holiday_nd',
	            'legal_holiday_nd_ot',
	            'legal_sun',
	            'legal_sun_ot',
	            'legal_sun_nd',
	            'legal_sun_nd_ot',
	            'no_work_legal_holiday',
	        ];
	}

	public function rateNames(){
	    return [
	        'Regular',
	        'Regular OT',
	        'Regular ND',
	        'Regular NDOT',
	        'Sunday',
	        'Sunday OT',
	        'Sunday ND',
	        'Sunday NDOT',
	        'SPL Holiday',
	        'SPL Holiday OT',
	        'SPL Holiday ND',
	        'SPL Holiday NDOT',
	        'Legal Holiday',
	        'Legal Holiday OT',
	        'Legal Holiday ND',
	        'Legal Holiday NDOT',
	        'Legal Sunday',
	        'Legal Sunday OT',
	        'Legal Sunday ND',
	        'Legal Sunday NDOT',
	        'No Work Legal Holiday'
	    ];
	}
}