<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertPayment extends Model
{
    protected $fillable = [
        'payment_type',
        'status',
        'contractor_id',
        'amount',
        'plan_advert_id',
        'approved_by'
    ];
}
