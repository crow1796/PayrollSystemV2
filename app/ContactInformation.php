<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    protected $table = 'contact_information';
    protected $fillable = [
    	'employee_id',
    	'mobile_number',
    	'telephone_number',
    	'emergency_name',
    	'emergency_number',
    ];
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'employee_id' => 'string'
    ];
    
    public function employee(){
    	return $this->belongsTo('\App\Employee', 'employee_id');
    }
}
