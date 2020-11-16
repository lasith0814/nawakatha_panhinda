<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferredBook extends Model
{
    use SoftDeletes;

    protected $fillable = ['ebook_id', 'is_like', 'bookmark_page_no', 'reader_id'];

    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }

//    public function bookmarks()
//    {
//        return $this->hasMany(Bookmark::class);
//    }

    public function ebook()
    {
        return $this->belongsTo(Ebook::class);
    }
}
