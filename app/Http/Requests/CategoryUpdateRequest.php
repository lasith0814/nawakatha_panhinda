<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->category->id;
        return [
            'name' => "required|min:3|max:75|unique:ebook_categories,name,$id",
            'note' => 'nullable|string|max:500',
        ];
    }

    public function attributes()
    {
        return[
            'name' => 'Category Name',
            'note' => 'Category Description',
        ];
    }
}
