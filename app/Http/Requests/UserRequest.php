<?php

namespace App\Http\Requests;

use App\User;
use App\UserAccessRole;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
      /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $max = UserAccessRole::count();
        return [
            'first_name' => 'required|min:3|max:25|spaceNotAllow',
            'last_name' => 'nullable|min:3|max:25|spaceNotAllow',
            'user_access_role_id' => "required|integer|min:2|max:$max",
            'nic' => 'required|unique:users|min:10|max:12|spaceNotAllow',
            'email' => 'required|email|unique:users|min:7|max:100',
            'mobile' => 'required|digits:10|unique:users|starts_with:073,074,079,077,076,071,070,075,078,072',
            'password' => 'required|confirmed|min:8|max:15|spaceNotAllow',
            'password_confirmation' => 'required|min:8|max:15|spaceNotAllow'
        ];
    }

    public function attributes()
    {
        return[
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'user_access_role_id' => 'Role ID',
            'nic' => 'NIC',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'password' => 'Password',
            'password_confirmation' => 'Password Confirmation',
        ];
    }
}
