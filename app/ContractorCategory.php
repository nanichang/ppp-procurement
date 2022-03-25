<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractorCategory extends Model
{
    protected $fillable = [
       
        'category_name', 'business_category_id', 'sub_category_name', 'business_sub_category_1',  'user_id',
     ];
}
