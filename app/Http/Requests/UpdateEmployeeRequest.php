<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class UpdateEmployeeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date_employed' => 'required|date_format:m/d/Y|before:' . \Carbon\Carbon::now()->addDay(2)->format('m/d/Y'),
            'first_name' => 'required|max:255',
            'middle_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'suffix' => 'max:20',
            'email' => 'email',
            'position' => 'required',
            'designation' => 'required',
            'department' => 'required',
            'business_unit' => 'required',
            'benefits[*]' => 'unique:employee_benefit,benefit_id_value',
            'mobile_number' => 'required',
            'emergency_name' => 'required',
            'emergency_number' => 'required',
            'date_of_birth' => 'date_format:m/d/Y|before:' . \Carbon\Carbon::now()->addDay(2)->format('m/d/Y'),
            'mother_name' => 'required',
            'father_name' => 'required'
        ];
    }
}
