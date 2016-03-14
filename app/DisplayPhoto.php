<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisplayPhoto extends Model
{
    protected $table = 'display_photos';
    protected $fillable = [
    	'employee_id',
    	'filename'
    ];
    protected $dates = [
    	'created_at',
    	'updated_at'
    ];

    public function employee(){
    	return $this->belongsTo('\App\Employee', 'employee_id');
    }
}
