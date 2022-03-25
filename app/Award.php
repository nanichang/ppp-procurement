<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    public function planAdvert(){
        return $this->belongsTo('App\PlanAdvert');
    }

    public function evaluator(){
        return $this->belongsTo('App\Evaluator', 'evaluator_admin_id');
    }

    public function contractor(){
        return $this->belongsTo('App\Contractor');
    }

    public function advertLot(){
        return $this->belongsTo('App\AdvertLot');
    }

    public function sales(){
        return $this->belongsTo('App\Sales');
    }

    public function mda(){
        return $this->belongsTo('App\Mda');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
