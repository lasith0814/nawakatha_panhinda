<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\Auditable\AuditableWithDeletesTrait;

class Ebook extends Model
{
    use AuditableWithDeletesTrait, SoftDeletes;

    protected $fillable = ['book_id', 'name', 'ebook_category_id', 'author_id', 'intro_quote', 'thumbnail_img', 'back_thumbnail_img'];

    public function referredBooks()
    {
        return $this->hasMany(ReferredBook::class)->withTrashed();
    }

//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }

    public function ebookCategory()
    {
        return $this->belongsTo(EbookCategory::class);
    }

    public function ebookPages()
    {
        return $this->hasMany(EbookPage::class)->withTrashed();
    }

    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function user_create()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function user_update()
    {
        return $this->belongsTo(User::class,'updated_by');
    }

    public function user_delete()
    {
        return $this->belongsTo(User::class,'deleted_by');
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('id', $value)->withTrashed()->firstOrFail();
    }

}
