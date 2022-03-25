<?php
namespace App\Repositories\Advert;
//namespace Carbon;
use App\PlanAdvert;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use App\Advert;
use App\AdvertLot;
use App\AdvertType;
use App\AdvertMode;

use Session;

class EloquentAdvertRepository implements AdvertContract {

    public function createAdvert($request) {
        $advert = new Advert;
        $this->setAdvertProperties($advert, $request);
         if($request->budget_year > date("Y")) {
            return 'Invalid Budget Year';
        }
         else if(Carbon::parse($request->bid_opening_date)->format('Y-m-d') <= Carbon::now()->format('Y-m-d')){
            return 'Invalid Bid Opening Date';
        }
        else if(Carbon::parse($request->closing_date)->format('Y-m-d') <= Carbon::now()->format('Y-m-d')){
            return 'Invalid Closing Date';
        }
        $advert->save();
        return 1;
    }

    public function editAdvert($request) {
        $advert = Advert::find($request->id);
        $advert->tender_collection = $request->tender_collection;
        $advert->tender_submission = $request->tender_submission;
        $advert->tender_opening = $request->tender_opening;
        return $advert->save();
    }


    public function listActiveAdverts(){
        return Advert::with('user')
        ->where("bid_opening_date", ">", Carbon::now()->format('Y-m-d'))
        ->where('status', 'active')
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public function listAllAdvertsForContractor(){
//        return Advert::with('user')
//        ->where("bid_opening_date", ">", Carbon::now()->format('Y-m-d'))
//        ->where('status', 'active')
//        ->orderBy('created_at', 'desc')
//        ->get();
        // return PlanAdvert::all();
        return PlanAdvert::where('approval_status', true)->get();
    }


    public function listAdvertsByMDA(){
        return Advert::where('user_id', Auth::user()->id)
            ->with('advertLot.tenderRequirement')
            ->with('advertLot')
            ->orderBy('created_at', 'DESC')
            ->get();

    }

    public function getAdsById($id){
        return PlanAdvert::find($id);
        // return Advert::where('id', $id)
        //     ->with('advertLot.tenderRequirement')
        //     ->with('advertLot')
        //     ->with('tenderRequirement')
        //     ->with('user')
        //     ->first();

    }

    public function getAdsByCatId($id){
     $records =  AdvertLot::where('advert_lot_business_category_id', $id)
        ->with('advert')
        ->with('user')
        ->with('advert.tenderRequirement')
        ->orderBy('created_at', 'desc')
        ->get();
        $ads = array();

        if(sizeof($records) > 0) {
            foreach($records as $data){
                $status = $data->advert->bid_opening_date > Carbon::now()->format('Y-m-d') ? 'text-success-dk' :'text-danger-dk';
                $route = $status=='text-success-dk' ?  'AdvertController@getAdvertById' : 'AdvertController@getAdvertById';
                $obj = new \stdClass;
                $obj->lot_id  =  $data->id;
                $obj->advert_id  =  $data->advert->id;
                $obj->description  =  $data->description;
                $obj->lot_amount  =  $data->lot_amount;
                $obj->tender_document  =  $data->tender_document;
                $obj->document_type  =  mime_content_type($data->tender_document);
                $obj->bid_opening_date  =  $data->advert->bid_opening_date;
                $obj->mda_name  =  $data->user->name;
                $obj->category_name = $data->category_name;
                $obj->closing_date = $data->advert->closing_date;
                $obj->status = $status;
                $obj->route = $route;

                if($data->advert->status=='active') {
                    array_push($ads, $obj);
                }


            }
        }

        return $ads;

    }

    public function closingBids(){
        $from =  Carbon::now()->format('Y-m-d');
        $to = Carbon::now() ->addDays(7)->format('Y-m-d');
        return Advert::whereBetween('closing_date', [$from, $to])
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

    }



    public function getAdvertById($advertId) {
        return Advert::with('tenderRequirement')->where("id", $advertId)->get()->first();
    }

    public function listAdvertsByUserId(){
        $data=  Advert::where("user_id", Auth::user()->id)->orderBy('created_at', 'DESC')->get();

        $ads = array();
            for($i=0; $i<sizeof($data); $i++){
                $lot = AdvertLot::where("advert_id", $data[$i]->id)->get();
                $obj = new \stdClass;
                $obj->id  =  $data[$i]->id;
                $obj->name  =  $data[$i]->name;
                $obj->budget_year  =  $data[$i]->budget_year;
                $obj->advert_type  =  $data[$i]->advert_type;
                $obj->advert_mode  =  $data[$i]->advert_mode;
                $obj->introduction  =  $data[$i]->introduction;
                $obj->advert_publish_date  =  $data[$i]->advert_publish_date;
                $obj->bid_opening_date  =  $data[$i]->bid_opening_date;
                $obj->closing_date  =  $data[$i]->closing_date;
                $obj->lots = sizeof($lot);
                $obj->user_id  =  $data[$i]->user_id;
                array_push($ads, $obj);

            }
        return $ads;
}

    public function listAllAdverts(){
        return Advert::with('user')
        ->orderBy('created_at', 'desc')
        ->get();;
    }


    public function listApprovedAdverts(){
        return Advert::with('user')
        ->where('status', 'active')
        ->orderBy('created_at', 'desc')
        ->get();;
    }

    public function removeAdvert($request) {
        try{
            $data = $request->aids;

            for($i=0; $i<sizeof($data); $i++){
                $tmp = Advert::where('id', $data[$i] )->delete();
            }
            return true;
        } catch (\Exception $e) {
            return false;
       }
    }

    public function updateAdvertStatus($advertId, $status){
        $advert = Advert::find($advertId);
        $advert->status = $status;
        return $advert->save();
    }


    private function setAdvertProperties($advert, $request) {
        $user = Auth::user();
        $advertMode = AdvertMode::where('id',  $request->advert_mode)->get()->first();
        $advertType = AdvertType::where('id',  $request->advert_type)->get()->first();
        $bid_opening_date = Carbon::parse($request->bid_opening_date);
        $advert->name = $request->name;
        $advert->budget_year = $request->budget_year;
        $advert->advert_type = $advertType->name;
        $advert->advert_mode = $advertMode->name;
        $advert->advert_type_id = $advertType->id;
        $advert->advert_mode_id = $advertMode->id;
        $advert->introduction = $request->introduction;
        $advert->advert_publish_date = Carbon::now()->format('Y-m-d');
        $advert->bid_opening_date = $bid_opening_date->format('Y-m-d');
        $advert->closing_date = Carbon::parse($request->closing_date)->format('Y-m-d');
        $advert->status = 'pending';
        $advert->user_id = $user->id;

    }

}
