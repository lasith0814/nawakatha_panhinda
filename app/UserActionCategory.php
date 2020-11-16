<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserActionCategory extends Model
{
    protected $fillable = [];
    public function userActions()
    {
        return $this->hasMany(UserAction::class);
    }
}
