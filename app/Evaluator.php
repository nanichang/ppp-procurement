<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Evaluator extends Model
{
    use Notifiable;
    protected $fillables = ['name', 'email', 'code', 'mda_id', 'advert_lot_id', 'plan_advert_id'];

    // protected $guarded = ['id'];
    
    // protected $hidden = ['code', 'remember_token'];



    public function mda() {
        return $this->belongsTo('App\Mda');
    }

    public function planAdvert() {
        return $this->belongsTo('App\PlanAdvert');
    }

    public function advertLot() {
        return $this->belongsTo('App\AdvertLot');
    }
}
