<?php
namespace App\Repositories\AdvertMode;

interface AdvertModeContract{
    public function find($id);
    
    public function listAllAdvertModes();

    public function allAdvertModes();

    public function createAdvertMode($requestData);
    
    public function update($id, $requestData);
    
    public function destroy($request);
}