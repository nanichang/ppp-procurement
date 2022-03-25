<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class AdvertLot extends Model{
    protected $fillable = [
        'project_status', 'project_name', 'advert_id',   'package_no', 'lot_no', 'description', 'advert_lot_business_category_id', 'category_name',
        'advert_mode', 'lot_amount', 'tender_document', 'tender_document_inhouse', 'cell_position', 'lot_requirement', 'custom_requirement',
     ];

     public function advert(){
        return $this->belongsTo('App\Advert');
    }

    public function planAdvert(){
        return $this->belongsTo('App\PlanAdvert');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function awards(){
        return $this->hasMany('App\Award');
    }

    public function tenderRequirement(){
        return $this->hasMany('App\TenderRequirement', 'lot_id');
    }

    public function businessCategory(){
        return $this->belongsToMany('App\AdvertLot');
    }

}
