<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertMode extends Model{
    protected $fillable = [
        'name', 'advert_type_name', 'advert_type_id',
    ];

    public function advertType(){
        return $this->belongsTo('App\AdvertType');
    }
}
