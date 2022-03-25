<?php
namespace App\Repositories\BusinessSubCategory2;

interface BusinessSubCategory2Contract       
{
    public function find($id);
    
    public function listBusinessSubCategory();

    public function allBusinessSubCategory();  
     
    public function create($requestData);
    
    public function update($id, $requestData);
    
    public function destroy($id);
}