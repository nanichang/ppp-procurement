<?php
namespace App\Repositories\CompanyOwnership;

use App\CompanyOwnership;

class EloquentCompanyOwnershipRepository implements CompanyOwnershipContract
{
    public function create($requestData)
    {
       return CompanyOwnership::create($requestData);
    }
    
    public function find($id)
    {
       return CompanyOwnership::find($id);
    }
    
    
    public function listCompanyOwnership()
    {
        return CompanyOwnership::all();
    }
    
    
    public function destroy($id)
    {
        $client = CompanyOwnership::findorFail($id);
        return $client->delete();
    }
    
    public function update($id, $requestData)
    {
       return CompanyOwnership::find($id)->update($requestData);
    }
    
}