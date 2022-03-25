<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessSubCategory1 extends Model{
    protected $fillable = ['name'];

    public function businessCategory(){
        return $this->belongsTo('App\BusinessCategory');
    }
}


