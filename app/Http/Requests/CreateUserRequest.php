<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class CreateUserRequest extends Request
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
            'username' => 'required|exists:employees,id|unique:bmpc_users,username',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'   
        ];
    }
}
