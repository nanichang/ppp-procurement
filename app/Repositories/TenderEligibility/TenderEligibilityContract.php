<?php
namespace App\Repositories\TenderEligibility;

interface TenderEligibilityContract{

    public function find($id);
    
    public function listAllEligibility();
    
    public function create($request);
    
    public function update($id, $request);
    
    public function destroy($request);
}