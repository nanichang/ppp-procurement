<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanAdvert extends Model
{
    public function advertDocuments() {
        return $this->hasMany('App\PlanAdvertDocument');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function procurementPlan(){
        return $this->belongsTo('App\ProcurementPlan');
    }

     public function advertLots(){
        return $this->hasMany('App\AdvertLot');
    }

    public function advertCriterias(){
        return $this->hasMany('App\AdvertCriteria');
    }
}
