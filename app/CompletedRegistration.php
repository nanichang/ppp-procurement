<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompletedRegistration extends Model
{
    protected $fillable = [
        'company_name', 'expiration_date', 'registration_category', 'category_id', 'amount', 'renewal', 'description', 'registration_id', 'user_id',
    ];
}
