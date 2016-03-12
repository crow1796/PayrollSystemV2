<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;

class DesignationRepository extends Repository{
	public function model(){
		return 'App\Designation';
	}
}