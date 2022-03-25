<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractorJobs extends Model{
    protected $fillable = [
       
        'job_category', 'category_name', 'sub_category', 'job_title', 'job_description', 'client', 'contact_phone',
        'award_date', 'amount', 'sub_categoryId',
     ];
}
