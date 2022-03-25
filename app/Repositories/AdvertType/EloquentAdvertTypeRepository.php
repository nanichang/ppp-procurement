<?php
namespace App\Repositories\AdvertType;

use App\AdvertType;

class EloquentAdvertTypeRepository implements AdvertTypeContract{

    public function createAdvertType($request){
        return AdvertType::create($request);
    }
   
    public function listAllAdvertTypes(){
        return AdvertType::with('advertMode')->get();
    }


    public function destroy($request){
        return AdvertType::destroy($request->ids);
      }

    public function allAdvertTypes(){ 
        return AdvertType::with('advertMode')->get();
    }
    
}