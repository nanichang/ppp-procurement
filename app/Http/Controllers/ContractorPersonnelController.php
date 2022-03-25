<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ContractorPersonnel\ContractorPersonnelContract;


class ContractorPersonnelController extends Controller
{
    protected $repo;


    public function __construct(ContractorPersonnelContract $contractorPersonnelContract){
        $this->middleware('auth');
        $this->repo = $contractorPersonnelContract;
      
    }
    
    public function personnels(){
        $personnels = $this->repo->getPersonnelsById();
        return response()->json($personnels, 200);
    }


    public function storePersonnel(Request $request) {
       try {
           $personnel = $this->repo->createPersonnel((object)$request->all());       
           if ($personnel == 1) {
               return response()->json(['success'=>'Record Added Successfully'], 200);        
            } else {     
                return response()->json(['error' => $personnel], 500);
            }
       } catch (QueryException $e) {
        \Log::info('errrorr... '.$e->getMessage());
        return response()->json(['error' => "Please fill up the required field and try again"], 500);
       }
    }

    public function deletePersonnel(Request $request) {
        try {
            $personnel = $this->repo->removePersonnel($request->all());  
            if ($personnel) {
                return response()->json(['success'=>' Records Deleted Successfully'], 200);
             } else {  
                return response()->json(['responseText' => 'Failed to Delete'], 500);
             }
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
        }
     }

}
