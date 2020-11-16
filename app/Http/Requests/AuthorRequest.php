<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:75|unique:authors',
            'note' => 'nullable|string|max:500',
        ];
    }

    public function attributes()
    {
        return[
            'name' => 'Author Name',
            'note' => 'Author Description',
        ];
    }
}
