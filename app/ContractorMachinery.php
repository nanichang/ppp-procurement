<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractorMachinery extends Model {


    protected $fillable = [
       
        'equipment_type', 'specifics', 'acquisition_date', 'cost', 'location', 'serial_no', 'equipment_status',
        'user_id', 
     ];
    
}
