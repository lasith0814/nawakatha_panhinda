<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Yajra\Auditable\AuditableWithDeletesTrait;

class Reader extends Authenticatable implements JWTSubject
{
    use AuditableWithDeletesTrait, SoftDeletes, Notifiable;

    protected $guard = 'api';

    protected $fillable = ['reader_access_role_id', 'first_name' , 'last_name', 'mobile', 'email', 'password' , 'remember_token',
        'created_at', 'updated_at' , 'deleted_at' , 'created_by' , 'updated_by' , 'deleted_by'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function readerAccessRole()
    {
        return $this->belongsTo(ReaderAccessRole::class);
    }

    public function referredBooks()
    {
        return $this->hasMany(ReferredBook::class);
    }

    public function user()
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
