<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model{


    protected $fillable = [
       
        'name', 'budget_year',  'advert_type', 'advert_mode', 'introduction', 'advert_publish_date',
        'bid_opening_date', 'closing_date', 'status', 'tender_collection', 'tender_submission', 'tender_opening', 
     ];


     public function user(){
        return $this->belongsTo('App\User');
    }

     public function advertLot(){
        return $this->hasMany('App\AdvertLot');
    }

    public function tenderRequirement(){
        return $this->hasMany('App\TenderRequirement');
    }
    
}
