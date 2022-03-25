<?php
namespace App\Repositories\TenderEligibility;

use App\TenderEligibility;

class EloquentTenderEligibilityRepository implements TenderEligibilityContract
{
    public function create($requestData)
    {
       return TenderEligibility::create($requestData);
    }

    public function find($id)
    {
       return TenderEligibility::find($id);
    }


    public function listAllEligibility()
    {
        return TenderEligibility::all();
    }


    public function destroy($request){

        $data = $request->ids;
        for($i = 0; $i < sizeof($data); $i++ ){
         $client = TenderEligibility::where('id', $data[$i])->delete();
        }
        return $client;

    }

    public function update($id, $requestData)
    {
       return TenderEligibility::find($id)->update($requestData);
    }

}
