<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertPaymentDocument extends Model
{
    protected $fillable = [
        'document',
        'advert_payment_id',
        'contractor_id'
    ];

    
}
