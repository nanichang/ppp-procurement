<?php
namespace App\Repositories\BusinessSubCategory1;
use App\BusinessSubCategory1;
use App\BusinessCategory;


class EloquentBusinessSubCategoryRepository implements BusinessSubCategoryContract{
    public function create($requestData){
        $catId = BusinessCategory::where('id', $requestData['business_category_id'])->first();
        $subCate = new BusinessSubCategory1();
        $subCate->name = $requestData['name'];
        $subCate->business_category_id = $catId->id;
        return $subCate->save();
    }
    
    public function find($id){
       return BusinessSubCategory1::find($id);
    }
    
    
    public function listBusinessSubCategory(){
        return BusinessSubCategory1::all()->pluck('name', 'id');
    }


    public function allBusinessSubCategories(){
        return BusinessSubCategory1::with('businessCategory')->get();
    }

    public function destroy($request){
        return BusinessSubCategory1::destroy($request->ids);
      }
    
    
    // public function destroy($id){
    //     $client = BusinessSubCategory1::findorFail($id);
    //     return $client->delete();
    // }
    
    public function update($id, $requestData){
       return BusinessSubCategory1::find($id)->update($requestData);
    }
    
}