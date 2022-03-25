<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistractionPaymentDocument extends Model
{
    protected $fillable = [
        'document', 
        'registration_payment_id',
        'contractor_id',
        'amount',
        'approved_by'
    ];
}
