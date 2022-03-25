<?php
namespace App\Repositories\AdvertMode;
use App\AdvertMode;
use App\AdvertType;


class EloquentAdvertModeRepository implements AdvertModeContract{
    public function createAdvertMode($requestData){
        $typeId = AdvertType::where('id', $requestData['advert_type_id'])->first();
        $advertMode = new AdvertMode();
        $advertMode->name = $requestData['name'];
        $advertMode->advert_type_id = $typeId->id;
        $advertMode->advert_type_name = $typeId->name;
        return $advertMode->save();
    }
    
    public function find($id){
       return AdvertMode::find($id);
    }
    
    public function listAllAdvertModes(){
        return AdvertMode::with('advertType')->get();
    }

    public function allAdvertModes(){
        return AdvertMode::with('advertType')->get();
    }

    public function destroy($request){
        return AdvertMode::destroy($request->ids);
     }

    public function update($id, $requestData){
       return AdvertMode::find($id)->update($requestData);
    }
    
}