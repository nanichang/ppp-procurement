<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationPayment extends Model
{
    protected $fillable = [
        'payment_type', 
        'status',
        'contractor_id',
        'amount',
        'approved_by'
    ];


    public function contractor() {
        return $this->belongsTo('App\Contractor');
    }

    public function documents() {
        return $this->hasMany('App\RegistractionPaymentDocument');
    }
}
