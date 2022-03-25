<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Director extends Model
{
    protected $fillable = [
       
        'first_name', 'last_name', 'gender', 'nationality', 'country', 'identification', 'professional_membership',
        'membership_id_no',
     ];
}
