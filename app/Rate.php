<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'rates';
    protected $fillable = [
    	'rateable_id',
    	'rateable_type',
    	'regular',
    	'regular_ot',
    	'regular_nd',
    	'regular_nd_ot',
    	'sun',
    	'sun_ot',
    	'sun_nd',
    	'sun_nd_ot',
    	'spl_holiday',
    	'spl_holiday_ot',
    	'spl_holiday_nd',
    	'spl_holiday_nd_ot',
    	'legal_holiday',
    	'legal_holiday_ot',
    	'legal_holiday_nd',
    	'legal_holiday_nd_ot',
    	'legal_sun',
    	'legal_sun_ot',
    	'legal_sun_nd',
    	'legal_sun_nd_ot',
    	'no_work_legal_holiday',
    ];

    protected $casts = [
        'regular' => 'float',
        'ot_regular' => 'float',
        'nd_regular' => 'float',
        'nd_ot_regular' => 'float',
        'sun' => 'float',
        'sun_ot' => 'float',
        'sun_nd' => 'float',
        'sun_nd_ot' => 'float',
        'sp_holiday' => 'float',
        'sp_holiday_ot' => 'float',
        'sp_holiday_nd' => 'float',
        'sp_holiday_nd_ot' => 'float',
        'legal_holiday' => 'float',
        'legal_holiday_ot' => 'float',
        'legal_holiday_nd' => 'float',
        'legal_holiday_nd_ot' => 'float',
        'legal_sun' => 'float',
        'legal_sun_ot' => 'float',
        'legal_sun_nd' => 'float',
        'legal_sun_nd_ot' => 'float',
        'no_work_legal_holiday' => 'float',
    ];

    public function rateable(){
    	return $this->morphsTo();
    }
}
