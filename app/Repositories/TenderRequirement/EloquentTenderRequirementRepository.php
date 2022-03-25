<?php

namespace App\Repositories\TenderRequirement;

use App\TenderRequirement;
use App\User;
use App\AdvertLot;
use App\TenderEligibility;
use App\Repositories\TenderRequirement\TenderRequirementContract;
use Illuminate\Support\Facades\Auth;
use Session;


class EloquentTenderRequirementRepository implements TenderRequirementContract{

    public function createTenderRequirement($request) {  
        $result;
        $advertLot = AdvertLot::where("advert_id", $request->advertId )->first();
        if($advertLot == null ) {
            return 'You Have to Create Lots Before Requirement';
        }

        $search = TenderRequirement::where('lot_id', $advertLot->id)
            ->get();
        if($search){
            $ids  = $search->map(function ($obj) {
                return $obj->id;
            });
            $this->deleteAll($ids);
        }
        if($request->requirement && count($request->requirement)){
            for($i=0; $i < sizeof($request->requirement); $i++){
                    $requirement = new TenderRequirement;
                    $this->setTenderRequirementProperties($requirement, $request, $i, $advertLot);
                    $result = $requirement->save();
            }
        }else{
            $result = true;
        }
        return $result;
    }

    public function deleteAll($ids) {
        TenderRequirement::destroy($ids);
    }


    public function listRequirementsByLotId($lotId) {
        return TenderRequirement::with('tenderEligibility')->where("lot_id", $lotId)->get();
    }

   

    private function setTenderRequirementProperties($requirement, $request, $index, $advert) {
          $user = Auth::user();
        $requirement->tender_eligibility_id = $request->requirement[$index];
        $te = TenderEligibility::find($request->requirement[$index]);
        $requirement->name = $te->certificate_name;
        $requirement->lot_id = $advert->id;
        $requirement->lot_no= $advert->lot_no;
        $requirement->advert_id = $request->advertId;
        $requirement->project_name = $advert->project_name;
        $requirement->user_id = Auth::user()->id;


    }


}


?>