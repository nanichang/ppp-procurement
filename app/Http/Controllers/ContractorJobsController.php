<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ContractorJobs\ContractorJobsContract;


class ContractorJobsController extends Controller {
    protected $repo;

    public function __construct(ContractorJobsContract $contractorjobsContract){
        $this->middleware('auth');
        $this->repo = $contractorjobsContract;  
    }

    public function getJobs(){
        $jobs = $this->repo->getJobsById();
        return response()->json(['jobs'=> $jobs], 200);
    }

    public function storeJob(Request $request) {
       try {
           $job= $this->repo->createJob((object)$request->all());       
           if ($job == 1) {
               return response()->json(['success'=>'Record Added Successfully'], 200);          
            } else {       
                return response()->json(['error' => $job], 500);
            }
       } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
       }
    }

    public function deleteJob(Request $request) {
        try {
            $job = $this->repo->removeJob($request->all());  
            if ($job) {
                return response()->json(['success'=>' Record Deleted Successfully'], 200);
             } else {  
                return response()->json(['responseText' => 'Failed to Delete'], 500);
             }
        } catch (\Exception $e) {
         return response()->json(['response' => $e->getMessage()], 500);
        }
     }
    //
}
