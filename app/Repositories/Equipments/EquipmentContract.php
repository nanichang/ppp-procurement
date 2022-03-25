<?php
namespace App\Repositories\Equipments;

interface EquipmentContract       
{
    public function find($id);
    
    public function listEquipments();

   // public function allEquipments();
    
    public function create($requestData);
    
    public function update($id, $requestData);
    
    public function destroy($ids);
}