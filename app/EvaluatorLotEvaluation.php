<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class EvaluatorLotEvaluation extends Model{

    public function advertLot(){
        return $this->belongsTo('App\AdvertLot');
    }

    public function evaluator(){
        return $this->belongsTo('App\Evaluator');
    }

    public function contractor(){
        return $this->belongsTo('App\Contractor');
    }

    public function advertCriteria(){
        return $this->belongsTo('App\AdvertCriteria');
    }

    public function sale(){
        return $this->belongsTo('App\Sales', 'sale_id');
    }

}
