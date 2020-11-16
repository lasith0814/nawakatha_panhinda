<?php

namespace App\Http\Requests;

use App\ReaderAccessRole;
use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;

class StoreReader extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $max = ReaderAccessRole::count();
        return [
            'first_name' => 'required|string|max:25',
            'last_name' => 'nullable|string|max:25',
            'mobile' => 'required|digits:10|starts_with:073,074,079,077,076,071,070,075,078,072|unique:readers',
            'email' => 'email|required|max:100',
            'reader_access_role_id' => "required|integer|min:1|max:$max",
            'password' => 'required|digits:4|confirmed',
            'password_confirmation' => 'required|digits:4',
        ];
    }
}
