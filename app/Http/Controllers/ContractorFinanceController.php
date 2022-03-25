<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ContractorFinance\ContractorFinanceContract;
use Illuminate\Database\Exception;


class ContractorFinanceController extends Controller {

    protected $repo;


    public function __construct(ContractorFinanceContract $contractorFinanceContract){

        $this->middleware('auth');
        $this->repo = $contractorFinanceContract;
      
    }
    
    public function getFinances(){
        $finances = $this->repo->getFinancesById();
        return response()->json(['finances'=> $finances], 200);
    }

    public function storeFinance(Request $request) {
       try {
           $finance= $this->repo->createFinance((object)$request->all());    
           if ($finance == 1) {
               return response()->json(['success'=>'Record Added Successfully'], 200);        
            } else {    
                return response()->json(['error' => $finance], 500);
            }
       } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
       }
    }

    public function deleteFinance(Request $request) {
        try {
            $finance = $this->repo->removeFinance($request->all());  
            if ($finance) {
                return response()->json(['success'=>' Records Deleted Successfully'], 200);
             } else {  
                return response()->json(['error' => 'Failed to Delete'], 500);
             }
        } catch (\Exception $e) {
         return response()->json(['error' => $e->getMessage()], 500);
        }
     }

}


