<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanAdvertDocument extends Model
{
    public function advert() {
        return $this->belongsTo('App\PlanAdvert');
    }
}
