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
        'name', 'email', 'password', 'cac', 'phone', 'registration_id'
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


    public function Contractor()
    {
        return $this->hasOne('App\Contractor');
    }


    public function advert()
    {
        return $this->hasMay('App\Advert');
    }

    public function MDA(){
        return $this->hasOne('App\User');
    }

    public function advertLots(){
        return $this->hasMany('App\AdvertLot');
    }
}
