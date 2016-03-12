<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyRecord extends Model
{
    protected $table = 'dailyrecords';
    protected $fillable = [
    	'employee_id',
    	'time_in',
    	'time_out',
    	'record_date',
    ];
    protected $dates = [
        'record_date',
        'created_at',
        'updated_at'
    ];

    public function employee(){
    	return $this->belongsTo('App\Employee', 'employee_id');
    }
}
