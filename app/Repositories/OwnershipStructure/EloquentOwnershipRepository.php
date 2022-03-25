<?php
namespace App\Repositories\OwnershipStructure;

use App\OwnershipStructure;

class EloquentOwnershipRepository implements OwnershipStructureContract
{
    public function create($requestData)
    {
       return OwnershipStructure::create($requestData);
    }
    
    public function find($id)
    {
       return OwnershipStructure::find($id);
    }
    
    
    public function listOwnershipStructure()
    {
        return OwnershipStructure::all();
    }
    
    
    public function destroy($ids)
    {
        return OwnershipStructure::destroy($ids->ids);
       // return $client->delete();
    }
    
    public function update($id, $requestData)
    {
       return OwnershipStructure::find($id)->update($requestData);
    }
    
}