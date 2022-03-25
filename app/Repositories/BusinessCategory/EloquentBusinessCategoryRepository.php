<?php
namespace App\Repositories\BusinessCategory;

use App\BusinessCategory;

class EloquentBusinessCategoryRepository implements BusinessCategoryContract{

    public function createBusinessCategory($request){
        return BusinessCategory::create($request);
    }
   
    public function listAllBusinessCategories(){
        return BusinessCategory::with('businessSubCategory')->get();
        //return BusinessCategory::all()->pluck('name', 'id');
    }


    public function destroy($request){
        return BusinessCategory::destroy($request->ids);
      }

    public function allBusinessCategories(){ 
        return BusinessCategory::with('businessSubCategory')->get();
    }
    
}