<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_deleted',
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

    /**
     * @param $query
     * @return mixed
     */
    public function scopeStream($query)
    {
        return $query->where('is_deleted', 0)->orderBy('id','desc');
    }

    public function scopeCekEmail($query,$email)
    {
        return $query->where('email', $email);
    }

    public function scopeIsDeleted($query)
    {
        return $query->where('is_deleted', 1);
    }

    public function scopeUpdateUser($query,$id,array $input)
    {
        return $query->where('id', $id)->update($input);
    }

    public function scopeDeleteUser($query,$id)
    {
        return $query->where('id', $id)->update(['is_deleted'=>1]);
    }
}
