<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class EmployeeTransactionRequest extends Request
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
            'time_in' => 'required|min:0|max:2400',
            'time_out' => 'required|min:0|max:2400'
        ];
    }
}
