<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;

class BusinessUnitRepository extends Repository{
	public function model(){
		return 'App\BusinessUnit';
	}
}