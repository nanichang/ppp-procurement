<?php
namespace App\Repositories\Qualifications;

interface QualificationContract       
{
    public function find($id);
    
    public function listQualifications();
    
    public function create($requestData);
    
    public function update($id, $requestData);
    
    public function destroy($ids);
}