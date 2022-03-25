<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ContractorMachinery\ContractorMachineryContract;


class ContractorMachineryController extends Controller {
    
    protected $repo;


    public function __construct(ContractorMachineryContract $contractorMachineryContract){
        $this->middleware('auth');
        $this->repo = $contractorMachineryContract;  
    }


    public function storeMachinery(Request $request) {
       try {
           $machinery = $this->repo->createMachinery((object)$request->all());     
           if ($machinery == 1) {
               return response()->json(['success'=>'Record Added Successfully.'], 200);       
            } else {   
                return response()->json(['error' => $machinery], 500);
            }
       } catch (QueryException $e) {
        return response()->json(['error' => $e->getMessage()], 500);
       }
    }

    public function getMachineries() {
        $machineries = $this->repo->getMachineriesById();
        return response()->json($machineries, 200);
    }

    public function deleteMachinery(Request $request) {
        try {
            $machinery = $this->repo->removeMachinery($request->all());  
            if ($machinery) {
                return response()->json(['success'=>' Records Deleted Successfully'], 200);
             } else {  
                return response()->json(['responseText' => 'Failed to Delete'], 500);
             }
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
        }
     }


}
