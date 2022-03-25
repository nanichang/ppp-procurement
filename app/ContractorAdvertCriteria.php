<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractorAdvertCriteria extends Model
{
    public function planAdvert(){
        return $this->belongsTo('App\PlanAdvert');
    }

    public function advertCriteria(){
        return $this->belongsTo('App\AdvertCriteria');
    }

    public function contractor(){
        return $this->belongsTo('App\Contractor');
    }
}
