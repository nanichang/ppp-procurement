<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenderRequirement extends Model{
    
     protected $fillable = ['name', 'tender_eligibility_id', 'lot_id', 'lot_no', 'advert_id', 'project_name', 'user_id' ];
    

     public function advertLot(){
          return $this->belongsTo('App\AdvertLot');
      }

      public function tenderEligibility(){
          return $this->belongsTo('App\TenderEligibility');
      }

      
}
