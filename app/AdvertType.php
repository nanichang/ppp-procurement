<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertType extends Model{
    protected $fillable = [
        'name',
    ];

    public function advertMode(){
        return $this->hasMany('App\AdvertMode');
    }
}
