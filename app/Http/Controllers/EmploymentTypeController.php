<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\QueryException;

use App\Repositories\EmploymentType\EmploymentTypeContract;

class EmploymentTypeController extends Controller
{
    protected $repo;

    public function __construct(EmploymentTypeContract $employmentTypeContract){
         $this->middleware('auth');
        $this->repo = $employmentTypeContract;
    }

    public function getAllEmploymentType() {

        try {
            $employmentType = $this->repo->listAllEmploymentType();

            if ($employmentType) {
                return response()->json(['success'=> $employmentType], 200);
            }
            else {
                return response()->json(['responseText' => 'Error retriving employment type'], 500);
            }
            
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
    }
}
