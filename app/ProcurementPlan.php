<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcurementPlan extends Model
{
    protected $table = 'procurement_plans';

    public function procurementYear() {
        return $this->belongsTo('App\ProcurementYear');
    }

    public function adverts() {
        return $this->hasMany('App\PlanAdvert');
    }

}
