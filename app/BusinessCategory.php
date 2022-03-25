<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
    protected $fillable = ['name'];

    public function advertLot(){
        return $this->hasMany('App\BusinessCategory');
    }

    public function businessSubCategory(){
        return $this->belongsTo('App\BusinessCategory');
    }
}
