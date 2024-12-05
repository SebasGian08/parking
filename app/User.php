<?php

namespace BolsaTrabajo;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $fillable = [
        'profile_id', 'nombres', 'email', 'password','estado','online','inicio_sesion'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function profile()
    {
        return $this->belongsTo('\BolsaTrabajo\Profile', 'profile_id');
    }
   
      
}
