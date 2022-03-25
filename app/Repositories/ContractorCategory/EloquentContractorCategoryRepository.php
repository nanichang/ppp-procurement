<?php

namespace App\Repositories\ContractorCategory;

use App\ContractorCategory;
use App\User;
use App\Repositories\ContractorCategory\ContractorCategoryContract;
use Illuminate\Support\Facades\Auth;
use App\BusinessCategory;
use App\BusinessSubCategory1;


use Session;


class EloquentContractorCategoryRepository implements ContractorCategoryContract{

    public function createCategory($request) { 
        $categorry = new ContractorCategory;
        $search = ContractorCategory::where('category', $request->category)
        ->where('user_id', Auth::user()->id)->get();
        if(sizeof($search) > 0) {
            return 'Category Already Exist';
        }
        $this->setContractorCategoryProperties($categorry, $request);
        $categorry->save();
        return 1;
    }


    public function getCategoriesById() {
        return ContractorCategory::where("user_id", Auth::user()->id)->get();
    }

    public function getCategories() {
        return ContractorCategory::all();
    }


    public function removeCategory($request){ 
        try {
          //  dd($request);
            $data = $request['cates'];
            for($i=0; $i<sizeof($data); $i++){
                $tmp = ContractorCategory::find($data[$i]);
                $tmp->delete();
                
            }
            return true;

        }
        catch(\Exception $e){
            dd($e->getMessage());
            return false;
        } 
    }

    private function setContractorCategoryProperties($categorry, $request) {
        $user = Auth::user();
        $business_cate = BusinessCategory::where('id',$request->category)->first();
        $sub_cate = BusinessSubCategory1::where('id',$request->subcategory_1)->first();
        $categorry->category = $business_cate->name;
        $categorry->business_category_id = $business_cate->id;
        $categorry->sub_category_name = $sub_cate->name;  
        $categorry->business_sub_category_1 = $sub_cate->id;
        $categorry->user_id = $user->id; 

    }

    public function find($id){
       return ContractorCategory::where('user_id', $id)->get();
    }


}


?>