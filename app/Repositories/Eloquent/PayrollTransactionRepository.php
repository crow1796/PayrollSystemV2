<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;

class PayrollTransactionRepository extends Repository{

	public function model(){
		return 'App\PayrollTransaction';
	}

	public function create($data = array()){
		$transaction = $this->model->where('cutoff_start', $data['cutoff_start'])
									->where('cutoff_end', $data['cutoff_end'])->get();
		$data['cutoff_start'] = \Carbon\Carbon::parse($data['cutoff_start'])->format('Y-m-d');
		$data['cutoff_end'] = \Carbon\Carbon::parse($data['cutoff_end'])->format('Y-m-d');
		if($transaction->count() > 0){
			return $this->updateByModel($data, $transaction[0]);
		}

		return parent::create($data);
	}

	public function updateByModel($data = array(), $model){
		$data['cutoff_start'] = \Carbon\Carbon::parse($data['cutoff_start'])->format('Y-m-d');
		$data['cutoff_end'] = \Carbon\Carbon::parse($data['cutoff_end'])->format('Y-m-d');
		return parent::updateByModel($data, $model);
	}
}