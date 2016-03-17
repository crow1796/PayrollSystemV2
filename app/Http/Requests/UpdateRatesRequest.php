<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateRatesRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'regular' => 'required|numeric|min:0',
            'regular_ot' => 'required|numeric|min:0',
            'regular_nd' => 'required|numeric|min:0',
            'regular_nd_ot' => 'required|numeric|min:0',
            'sun' => 'required|numeric|min:0',
            'sun_ot' => 'required|numeric|min:0',
            'sun_nd' => 'required|numeric|min:0',
            'sun_nd_ot' => 'required|numeric|min:0',
            'spl_holiday' => 'required|numeric|min:0',
            'spl_holiday_ot' => 'required|numeric|min:0',
            'spl_holiday_nd' => 'required|numeric|min:0',
            'spl_holiday_nd_ot' => 'required|numeric|min:0',
            'legal_holiday' => 'required|numeric|min:0',
            'legal_holiday_ot' => 'required|numeric|min:0',
            'legal_holiday_nd' => 'required|numeric|min:0',
            'legal_holiday_nd_ot' => 'required|numeric|min:0',
            'legal_sun' => 'required|numeric|min:0',
            'legal_sun_ot' => 'required|numeric|min:0',
            'legal_sun_nd' => 'required|numeric|min:0',
            'legal_sun_nd_ot' => 'required|numeric|min:0',
            'no_work_legal_holiday' => 'required|numeric|min:0',
        ];
    }
}
