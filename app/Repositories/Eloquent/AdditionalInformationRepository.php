<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;

class AdditionalInformationRepository extends Repository{
	public function model(){
		return '\App\AdditionalInformation';
	}
}