<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compliance extends Model
{
    // protected $fillable = ['ownership_structure'];
    protected $fillable = [
        'company_name', 'parent_company', 'cac_date_of_reg',  'cac_number', 'tcc_tin_no', 'tcc_ownership_structure',
        'tcc_company_ownership', 'pension_employer_code', 'pension_certificate_number', 'pension_expiring_date', 'pension_no_of_employee',
        'itf_registration_no', 'itf_certificate_no', 'itf_payment_date', 'user_id',
    ];
}
