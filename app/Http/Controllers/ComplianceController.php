<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\Exception;
use Session;

use App\Repositories\Compliance\ComplianceContract;


class ComplianceController extends Controller{
    protected $repo;

    public function __construct(ComplianceContract $complianceContract){
        $this->middleware('auth');
        $this->repo = $complianceContract;
    }
    


    public function storeCompliance(Request $request) {

       try {
           $compliance = $this->repo->createCompliance((object)$request->all());
           if ($compliance == 1) {
               return response()->json(['success'=>'Record Added Succesfully.'], 200);    
            }
            else { 
                return response()->json(['error' => $compliance], 500);
            }
       } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);

       }
    }

    public function getCompliance() {

        try {
            $getCompliance = $this->repo->listAllCompliance();

            if ($getCompliance) {
                return response()->json(['success'=> $getCompliance], 200);
            }
            else {
                return response()->json(['responseText' => 'Error retriving contractor compliance'], 500);
            }
            
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
    }

}
