<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $id = Auth::user()->id;
        return [
            'email' => "required|email|unique:users,email,$id|min:7|max:100",
            'mobile' => "required|digits:10|unique:users,mobile,$id|starts_with:073,074,079,077,076,071,070,075,078,072",
        ];
    }
}
