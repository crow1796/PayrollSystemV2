<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Employee extends Model implements SluggableInterface
{
    use SluggableTrait;
    protected $table = 'employees';
    protected $fillable = [
    	'position_id',
    	'designation_id',
    	'department_id',
    	'business_unit_id',
        'date_employed',
    	'first_name',
    	'middle_name',
    	'last_name',
    	'suffix',
    	'street',
    	'city',
    	'province',
    	'zipcode',
    	'gender'
    ];
    protected $dates = ['date_employed', 'created_at', 'updated_at', 'deleted_at'];
    protected $sluggable = [
        'build_from' => 'fullnameslug',
        'save_to' => 'slug',
        'on_update' => true
    ];
    protected $casts = [
        'id' => 'string',
        'benefits.pivot.value' => 'string',
        'active' => 'boolean',
        'slug' => 'string'
    ];

    public function contactInformation(){
    	return $this->hasOne('\App\ContactInformation', 'employee_id');
    }

    public function additionalInformation(){
    	return $this->hasOne('\App\AdditionalInformation', 'employee_id');
    }

    public function benefits(){
    	return $this->belongsToMany('\App\Benefit', 'employee_benefit', 'employee_id', 'benefit_id')
                    ->withTimestamps()
                    ->withPivot('benefit_id_value');
    }

    public function dailyTimeRecords(){
        return $this->hasMany('App\DailyRecord', 'employee_id');
    }

    public function accessInformation(){
        return $this->hasOne('\App\User', 'id');
    }

    public function department(){
        return $this->belongsTo('\App\Department', 'department_id');
    }

    public function position(){
        return $this->belongsTo('\App\Position', 'position_id');
    }

    public function designation(){
        return $this->belongsTo('\App\Designation', 'designation_id');
    }

    public function businessUnit(){
        return $this->belongsTo('\App\BusinessUnit', 'business_unit_id');
    }

    public function getFullnameslugAttribute(){
        $fullname = $this->first_name . '-' . $this->middle_name . '-' . $this->last_name . '-' . $this->id;
        return strtolower($fullname);
    }

    public function getFullnameAttribute(){
        $fullname = $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name . ' ' . $this->suffix;
        return $fullname;
    }

    public function logs(){
        return $this->hasManyThrough('\App\Log', 'App\User', 'id', 'user_id');
    }
}
