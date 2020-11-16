<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{
    protected $fillable =[];

    public function userAccessRoles()
    {
        return $this->belongsToMany(UserAccessRole::class)->withTimestamps();
    }

    public function userActionCategory()
    {
        return $this->belongsTo(UserActionCategory::class);
    }
}
