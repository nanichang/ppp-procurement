<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertCriteria extends Model
{
    public function planAdvert(){
        return $this->belongsTo('App\PlanAdvert');
    }

}
