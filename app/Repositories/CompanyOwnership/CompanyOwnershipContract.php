<?php
namespace App\Repositories\CompanyOwnership;

interface CompanyOwnershipContract       
{
    public function find($id);
    
    public function listCompanyOwnership();
    
    public function create($requestData);
    
    public function update($id, $requestData);
    
    public function destroy($id);
}