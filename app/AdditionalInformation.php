<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalInformation extends Model
{
    protected $table = 'additional_information';
    protected $fillable = [
    	'employee_id',
    	'date_of_birth',
    	'place_of_birth',
    	'weight',
    	'height',
    	'religion',
    	'civil_status',
    	'educational_attainment',
    	'course',
    	'mother_name',
    	'father_name'
    ];

    protected $dates = [
    	'date_of_birth',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'employee_id' => 'string',
        'slug' => 'string'
    ];

    public function employee(){
    	return $this->belongsTo('\App\Employee', 'employee_id');
    }
}
