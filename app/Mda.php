<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Mda extends Model{
    use Notifiable;
    protected $fillable = ['name', 'profile_pic', 'mda_code', 'mda_shortcode', 'subsector', 'address',
    'email', 'password', 'mandate', 'bank_name', 'bank_account', 'split_percentage'];


    public function evaluators() {
        return $this->hasMany('App\Evaluator');
    }

    // public function sales() {
    //     return $this->belongsTo('App\Mda');
    // }
}
