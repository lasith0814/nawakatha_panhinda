<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReaderAccessRole extends Model
{
    protected $guarded = [];

    public function readers()
    {
        return $this->hasMany(Reader::class);
    }
}
