<?php

namespace App\Repositories\PlanAdvert;

use App\PlanAdvert;
use App\PlanAdvertDocument;
use App\Repositories\PlanAdvert\PlanAdvertContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\AdvertMode;
use App\AdvertType;
use App\AdvertLot;
use App\Sales;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EloquentPlanAdvertRepository implements PlanAdvertContract {
    //
    public function create($request)
    {
        try{
            $user = Auth::user();
            DB::beginTransaction();
            $advert = new PlanAdvert();
            $advert->name = $request->name;
            $advert->budget_year = $request->budget_year;
            $advertMode = AdvertMode::where('id',  $request->advert_mode)->get()->first();
            $advertType = AdvertType::where('id',  $request->advert_type)->get()->first();
            if(!$advertType){
                throw new \Exception("Advert type is compulsory");
            }
            if(!$advertMode){
                throw new \Exception("Advert mode is compulsory");
            }
            $advert->advert_type = $advertType->name;
            $advert->advert_mode = $advertMode->name;
            $advert->advert_type_id = $advertType->id;
            $advert->advert_mode_id = $advertMode->id;

            $advert->introduction = $request->introduction;
            $advert->advert_plan_desc = $request->advert_plan_desc;
            $advert->bid_opening_date = $request->bid_opening_date;
            $advert->closing_date = $request->closing_date;
            $advert->mda_id = $request->mda_id;
            $advert->procurement_plan_id = $request->procurement_plan_id;
            $advert->year_id = $request->year_id;
            $advert->user_id = $user->id;
            $advert->save();
            if($request->hasFile('advert_document')) {
                foreach(array_combine($request->document_title, $request->file('advert_document')) as $title => $document) {
                    $advertDoc = new PlanAdvertDocument();
                    $filenamewithoutext = pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $document->getClientOriginalExtension();
                    $filename = $filenamewithoutext.'_'.time().'.'.$extension;
                    $directory = 'uploads/'.$filename;
                    $uploaded = Storage::disk('s3')->put( $directory,  file_get_contents($document) , 'public');
                    if($uploaded) {
                        $advertDoc->document_url = $directory;
                    }
                    $advertDoc->document_title = $title;
                    $advertDoc->advert_id = $advert->id;
                    $advertDoc->save();
                }
            }
            if ($advert) {
                DB::commit(); return $advert->id;
            } else {
                DB::rollback(); return 0;
            }
        }catch(\Exception $e){
            return 0;
        }
    }

    public function getAll()
    {
        return PlanAdvert::all();
    }

    public function getAllByCategory($Id){
        //advert_publish_date
        return PlanAdvert::leftJoin('procurement_plans', 'procurement_plans.id', '=', 'plan_adverts.procurement_plan_id')
            // ->where("bid_opening_date", "<", Carbon::now()->format('Y-m-d'))
            // ->where('plan_adverts.approval_status', true)
            ->where('procurement_plans.business_category_id', $Id)
            ->orderBy('plan_adverts.created_at', 'desc')
            ->select('plan_adverts.*', 'procurement_plans.business_category_id')
            ->get();
    }

    public function getById($id)
    {
        return PlanAdvert::where('id', $id)->first();
    }

    public function updateAdvertStatus($advertId, $status){
        $advert = PlanAdvert::find($advertId);
        $advert->status = $status; //to use this status to mean published
        if($status == 'active'){
            $advert->advert_publish_date = Carbon::now();
        }
        return $advert->save();
    }

    public function getByProcurementPlanId($id)
    {
        return PlanAdvert::where('procurement_plan_id', $id)->get();
    }

    public function getAllOpeningAdverts(){
        return PlanAdvert::
            // where("bid_opening_date", "<", Carbon::now()->format('Y-m-d'))
            where("closing_date", "<", Carbon::now()->format('Y-m-d'))
            ->where('approval_status', true)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getMDAAdverts($id){
        return PlanAdvert::
            // where("bid_opening_date", "<", Carbon::now()->format('Y-m-d'))
            where('mda_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getMDAOpeningAdverts($id){
        return PlanAdvert::
            // where("bid_opening_date", "<", Carbon::now()->format('Y-m-d'))
            where("closing_date", "<", Carbon::now()->format('Y-m-d'))
            ->where('mda_id', $id)
            ->where('approval_status', true)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getMDAAdvertsByCategory($mdaId, $Id){
        return PlanAdvert::leftJoin('procurement_plans', 'procurement_plans.id', '=', 'plan_adverts.procurement_plan_id')
            // ->where("bid_opening_date", "<", Carbon::now()->format('Y-m-d'))
            // ->where('plan_adverts.approval_status', true)
            ->where('plan_adverts.mda_id', $mdaId)
            ->where('procurement_plans.business_category_id', $Id)
            ->orderBy('plan_adverts.created_at', 'desc')
            ->select('plan_adverts.*', 'procurement_plans.business_category_id')
            ->get();
    }

    public function approveAdvertDocuments($request, $id)
    {
        $advert = $this->getById($id);
        $advert->approval_status = true;
        // $advert->status = 'active';
        $advert->save();
        return 1;
    }

    public function disapproveAdvert($request, $id)
    {
        $advert = $this->getById($id);
        $advert->approval_status = false;
        // $advert->status = 'active';
        $advert->save();
        return 1;
    }

    public function removeAdvert($request) {
        try{
            $data = $request->aids;

            for($i=0; $i<sizeof($data); $i++){
                $tmp = PlanAdvert::where('id', $data[$i])->where('approval_status', false)->delete();
            }
            return true;
        } catch (\Exception $e) {
            return false;
       }
    }

    public function listAdvertsByPlanId($planId){
        $data=  PlanAdvert::where("procurement_plan_id", $planId)->orderBy('created_at', 'DESC')->get();

        $ads = array();
        for($i=0; $i<sizeof($data); $i++){
            $lot = AdvertLot::where("plan_advert_id", $data[$i]->id)->get();
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
            array_push($ads, $obj);
        }
        return $ads;
    }

    public function listAllPublishedAdverts(){
        //advert_publish_date
        // return PlanAdvert::where("closing_date", ">=", Carbon::now()->format('Y-m-d'))
        return PlanAdvert::where('approval_status', true)
            ->where('status', 'active')
            ->where("closing_date", ">=", Carbon::now()->format('Y-m-d'))
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function listAllPublishedAdvertsByCategory($Id){
        //advert_publish_date
        return PlanAdvert::leftJoin('procurement_plans', 'procurement_plans.id', '=', 'plan_adverts.procurement_plan_id')
            ->where("plan_adverts.closing_date", ">=", Carbon::now()->format('Y-m-d'))
            ->where('plan_adverts.approval_status', true)
            ->where('plan_adverts.status', 'active')
            ->where('procurement_plans.business_category_id', $Id)
            ->orderBy('plan_adverts.created_at', 'desc')
            ->select('plan_adverts.*', 'procurement_plans.business_category_id')
            ->get();
    }

    public function getPublishedAdvertById($id){
        // return PlanAdvert::where("closing_date", ">=", Carbon::now()->format('Y-m-d'))
        return PlanAdvert::where('approval_status', true)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->find($id);
    }

    public function listAllAdverts(){
        return PlanAdvert::orderBy('created_at', 'desc')->get();
    }


    public function listAdvertsByMDA(){
        return Advert::where('user_id', Auth::user()->id)
            ->with('advertLot.tenderRequirement')
            ->with('advertLot')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function editMDAAdvert($request) {
        $advert = PlanAdvert::find($request->id);
        $advert->tender_collection = $request->tender_collection;
        $advert->tender_submission = $request->tender_submission;
        $advert->tender_opening = $request->tender_opening;
        return $advert->save();
    }

    public function findByMdaId($id) {
        return PlanAdvert::where('mda_id', $id)->get();
    }

    public function awardContractToContractor($request) {
        DB::beginTransaction();
        $allAwardedPlans = PlanAdvert::where('is_awarded', true)->get();
        foreach($allAwardedPlans as $awardedPlan) {
            $awardedPlan->is_awarded = false;
            $awardedPlan->save();
        }
        $sale = Sales::where('advert_lot_id', $request->advert_lot_id)->first();
        $planAdvert = PlanAdvert::where('mda_id',$request->mda_id)->first();
        $planAdvert->is_awarded = true;
        $planAdvert->save();
        if($planAdvert){
            $sale->report = $request->report;
            $sale->reported_by = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            $sale->save();
            DB::commit();
            return 1;
        } else {
            DB::rollback();
            return 0;
        }
    }
}
