<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class UserAccessRole extends Model
{
    use AuditableTrait;

    protected $fillable = ['role_name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function userActions()
    {
        return $this->belongsToMany(UserAction::class)->withTimestamps();
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
