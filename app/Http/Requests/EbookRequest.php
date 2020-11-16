<?php

namespace App\Http\Requests;

use App\Author;
use App\EbookCategory;
use Illuminate\Foundation\Http\FormRequest;

class EbookRequest extends FormRequest
{
      /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $maxCategory = EbookCategory::count();
        $maxAuthor = Author::count();
        return [
            'book_id' => 'required|min:3|max:25|unique:ebooks|spaceNotAllow',
            'name' => 'required|min:3|max:50',
            'ebook_category_id' => "required|integer|min:1|max:$maxCategory",
            'author_id' => "required|integer|min:1|max:$maxAuthor",
            'intro_quote' => 'nullable|string|min:5|max:300',
            'thumbnail_img' => 'required|file|image|mimes:jpeg,jpg,png|between:5,1024|dimensions:height=300,width=200',
            'back_thumbnail_img' => 'nullable|file|image|mimes:jpeg,jpg,png|between:5,1024|dimensions:height=300,width=200'
        ];
    }

    public function attributes()
    {
        return[
            'book_id' => 'Book ID',
            'name' => 'Book Name',
            'ebook_category_id' => 'Category ID',
            'author_id' => 'Author ID',
            'intro_quote' => 'Intro Quote',
            'thumbnail_img' => 'Cover Image',
            'back_thumbnail_img' => 'Back Image',
        ];
    }

    public function messages()
    {
        return [
            'thumbnail_img.dimensions' => 'Cover Image must be width:200px and height:300px',
            'back_thumbnail_img.dimensions' => 'Back Image must be width:200px and height:300px',
        ];
    }
}
