<?php
namespace App\Repositories\OwnershipStructure;

interface OwnershipStructureContract       
{
    public function find($id);
    
    public function listOwnershipStructure();
    
    public function create($requestData);
    
    public function update($id, $requestData);
    
    public function destroy($id);
}