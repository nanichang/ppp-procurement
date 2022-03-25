<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ContractorCategory\ContractorCategoryContract;

class ContractorCategoryController extends Controller{
    public function __construct(ContractorCategoryContract $categoryContract){
        $this->middleware('auth');
        $this->repo = $categoryContract;
    }
       
    public function storeCategory(Request $request) {
       try {
           $category = $this->repo->createCategory((object)$request->all());       
           if ($category == 1) {
               return response()->json(['success'=>'Record Added Successfully.'], 200);         
            } else {  
              return response()->json(['error' => $category], 500);
            }
       } catch (QueryException $e) {
        return response()->json(['response' => $e->getMessage()], 500);
       }
    }

    public function deleteCategory(Request $request) {
        try {
            $category = $this->repo->removeCategory($request->all());     
            if ($category) {
                return response()->json(['success'=>' Records Deleted Successfully'], 200);
             } else {  
                return response()->json(['responseText' => 'Failed to Delete'], 500);
             }
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
        }
    }

    public function categories() {
        $categories = $this->repo->getCategoriesById();
        return response()->json(['categories'=> $categories], 200);
    }




}
