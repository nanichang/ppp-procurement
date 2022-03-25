<?php
namespace App\Repositories\CategoryFee;

use App\CategoryRegistrationFee;

class EloquentCategoryFeeRepository implements CategoryFeeContract
{
    public function create($requestData)
    {
       return CategoryRegistrationFee::create($requestData);
    }
    
    public function find($id)
    {
       return CategoryRegistrationFee::find($id);
    }
    
    
    public function listAllFee(){
        return CategoryRegistrationFee::all();
    }
    
    
    public function destroy($request){
      return CategoryRegistrationFee::destroy($request->ids);
    }
    
    public function update($id, $requestData)
    {
       return CategoryRegistrationFee::find($id)->update($requestData);
    }
    
}