<?php
namespace App\Repositories\BusinessSubCategory2;

use App\BusinessSubCategory2;

class EloquentBusinessSubCategory2Repository implements BusinessSubCategory2Contract
{
    public function create($requestData)
    {
       return BusinessSubCategory2::create($requestData);
    }
    
    public function find($id)
    {
       return BusinessSubCategory2::find($id);
    }
    
    
    public function listBusinessSubCategory()
    {
        return BusinessSubCategory2::all()->pluck('name', 'id');
    }

    public function allBusinessSubCategory()
    {
        return BusinessSubCategory2::all();
    }
    
    
    public function destroy($id)
    {
        $client = BusinessSubCategory2::findorFail($id);
        return $client->delete();
    }
    
    public function update($id, $requestData)
    {
       return BusinessSubCategory2::find($id)->update($requestData);
    }
    
}