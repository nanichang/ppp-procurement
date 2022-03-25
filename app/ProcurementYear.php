<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcurementYear extends Model
{
    public function procurementPlans() {
        return $this->hasMany('App\ProcurementPlan');
    }
}
