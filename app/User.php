<?php

namespace App;

use Highlight\Mode;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Yajra\Auditable\AuditableWithDeletesTrait;


class User extends Authenticatable
{
    use AuditableWithDeletesTrait, SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'nic', 'mobile', 'email', 'password', 'user_access_role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userAccessRole()
    {
       return $this->belongsTo(UserAccessRole::class);
    }

//    public function ebooks()
//    {
//        return $this->hasMany(Ebook::class);
//    }

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

}
