<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable = ['advert_lot_id', 'lot_description', 'advert_id', 'advert_introduction', 'advert_name',  'amount', 'user_id', 'user_name', 'mda_id', 'mda_name', 'transaction_id', 'payment_status', 'payment_date', 'contractor_bid_amount', 'variation'];

    public function advertLot() {
        return $this->belongsTo('App\AdvertLot');
    }

    public function contractor() {
        return $this->belongsTo('App\Contractor');
    }

    public function planAdvert() {
        return $this->belongsTo('App\PlanAdvert', 'advert_id');
    }

    public function awards() {
        return $this->hasMany('App\Award');
    }

    public function evaluatorLotEvaluations(/*$evaluatorId = null*/) {
        // if($evaluatorId){
        //     return $this->hasMany('App\EvaluatorLotEvaluation', 'sale_id','id')->where('evaluator_id', $evaluatorId);
        // }else{
            return $this->hasMany('App\EvaluatorLotEvaluation', 'sale_id','id');
        // }
    }
}
