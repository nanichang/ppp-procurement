<?php
namespace App\Repositories\BusinessSubCategory1;

interface BusinessSubCategoryContract       
{
    public function find($id);
    
    public function listBusinessSubCategory();

    public function allBusinessSubCategories();

    
    public function create($requestData);
    
    public function update($id, $requestData);
    
    public function destroy($request);
}