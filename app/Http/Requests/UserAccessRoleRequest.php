<?php

namespace App\Http\Requests;

use App\UserAction;
use Illuminate\Foundation\Http\FormRequest;

class UserAccessRoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $max = UserAction::count();
        return [
            'role_name' => 'required|min:3|max:50|unique:user_access_roles',
            'actions' => 'required|array',
            'actions.*' => "integer|min:1|max:$max|distinct",
        ];
    }

    public function messages()
    {
        return [
            'role_name.required' => 'The Role Name field is required.',
            'role_name.unique' => 'This Role Name already in system',
            'role_name.max' => 'The Role Name field allows 50 characters only.',
            'role_name.min' => 'The Role Name field requires at least 3 characters.',
            'actions.required' => 'The Permission fields are required. You have to grant at least one permission',
            'actions.integer' => 'Invalid Input',
            'actions.min' => 'Invalid Input',
            'actions.max' => 'Invalid Input',
            'actions.distinct' => 'Invalid Input',
            'actions.array' => 'Invalid Input',
        ];
    }
}
