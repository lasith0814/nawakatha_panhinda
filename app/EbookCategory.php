<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class EbookCategory extends Model
{
    use AuditableTrait;

    protected $fillable = ['name' , 'note'];

    public function ebooks()
    {
        return $this->hasMany(Ebook::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function user_update()
    {
        return $this->belongsTo(User::class,'updated_by');
    }
}
