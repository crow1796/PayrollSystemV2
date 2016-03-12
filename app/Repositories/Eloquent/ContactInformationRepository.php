<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;

class ContactInformationRepository extends Repository{

	public function model(){
		return '\App\ContactInformation';
	}

}