<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    protected $fillable = [
       
       'company_name', 'email', 'cac_number', 'address', 'city', 'country', 'user_id',
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function director(){
        return $this->hasMany('App\Director');
    }

    public function personnel(){
        return $this->hasMany('App\ContractorPersonnel');
    }
    
}
