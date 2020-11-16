<?php

namespace App\Http\Requests;

use App\ReaderAccessRole;
use Illuminate\Foundation\Http\FormRequest;

class ReaderUpdateRequest extends FormRequest
{
      /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->reader->id;
        $max = ReaderAccessRole::count();
        return [

            'first_name' => 'required|min:3|max:25|spaceNotAllow',
            'last_name' => 'nullable|min:3|max:25|spaceNotAllow',
            'reader_access_role_id' => "required|integer|min:1|max:$max",
            'email' => "required|email|unique:readers,email,$id|min:7|max:100",
            'mobile' => "required|digits:10|unique:readers,mobile,$id|starts_with:073,074,079,077,076,071,070,075,078,072",
        ];
    }

    public function attributes()
    {
        return[
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'reader_access_role_id' => 'Role ID',
            'email' => 'Email',
            'mobile' => 'Mobile',
        ];
    }
}
