<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryRegistrationFee extends Model{

    
        protected $fillable = [
            'name', 'description', 'amount', 'renewal_fee',
        ];
    
    
}
