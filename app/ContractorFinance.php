<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractorFinance extends Model{
    protected $fillable = [
       
        'year', 'turn_over', 'total_asset', 'total_liability', 'witholding_tax', 'tax_paid', 'tcc_no',
        'audit_firm', 'report_date', 'report_date' 
     ];
}



