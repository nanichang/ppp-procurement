<?php
namespace App\Repositories\CategoryFee;

interface CategoryFeeContract{
    public function find($id);
    
    public function listAllFee();
    
    public function create($requestData);
    
    public function update($id, $requestData);
    
    public function destroy($request);
}