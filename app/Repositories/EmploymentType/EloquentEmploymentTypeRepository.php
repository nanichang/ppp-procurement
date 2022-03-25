<?php
namespace App\Repositories\EmploymentType;

use App\EmploymentType;

class EloquentEmploymentTypeRepository implements EmploymentTypeContract
{
   
    public function listAllEmploymentType()
    {
        return EmploymentType::all()->pluck('name', 'id');
    }
    
}