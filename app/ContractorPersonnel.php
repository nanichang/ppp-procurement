<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractorPersonnel extends Model
{
    protected $fillable = [
       
        'first_name', 'last_name', 'gender', 'nationality', 'country', 'passport_no', 'national_id_no',
        'employment_type', 'experience_years', 'joining_date', 'school_name', 'qualification', 'graduation_year',
         'regulatory_body', 'membership_id_no', 'project_involved', 'description', 'user_id',
     ];
}
