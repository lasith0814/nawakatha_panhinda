<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\Auditable\AuditableWithDeletesTrait;

class EbookPage extends Model
{
    use AuditableWithDeletesTrait, SoftDeletes;

    protected $fillable = ['ebook_id', 'contents' ];

    public function ebook()
    {
        return $this->belongsTo(Ebook::class);
    }

    public function bookmark()
    {
        return $this->hasOne(Bookmark::class);
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
