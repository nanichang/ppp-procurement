<?php
namespace App\Repositories\AdvertLot;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use App\AdvertLot;
use App\BusinessCategory;
use Session;
use Illuminate\Support\Facades\Storage;
use App\Advert;
use App\Imports\ImportTenderDocumentInHouse;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class EloquentAdvertLotRepository implements AdvertLotContract {

    public function createAdvertLot($request) {
        $advertLot = new AdvertLot();
        $this->setAdvertLotProperties($advertLot, $request);
        if(!$advertLot->inhouse_bid_amount){
            $advertLot->delete();
            return null;
        }
        return $advertLot->save();
    }


    public function listAllAdvertLotsByStatus($status){
        //return Advert::where("status", $status)->get();
        return AdvertLot::all();
    }

    public function listAdvertLotsByUserId(){
        return Advert::where("user_id", Auth::user()->id)->get();
    }

    public function listAllAdvertLots(){
        return AdvertLot::all();
    }

    public function listAdsByUserIdandCategory($categoryId){
        return AdvertLot::where("user_id", Auth::user()->id)
        ->where('advert_lot_business_category_id', $categoryId )
        ->get();
    }


    public function countAdvertsByCategory($categoryId){
        return AdvertLot::where('advert_lot_business_category_id', $categoryId )
        ->count();
    }


    public function removeAdvertLot($request) {
        try{
            $data = $request->lids;

            for($i=0; $i<sizeof($data); $i++){
                $tmp = AdvertLot::where('id', $data[$i] )->delete();
            }
            return true;
        } catch (\Exception $e) {
            return false;
       }
    }


    private function setAdvertLotProperties($advertLot, $request) {
        $user = Auth::user();
        $category =  BusinessCategory::where("id", $request->lot_category)->get();
        $projectName = $request->project_name !=null ? $request->project_name : '';        
        $advertLot->project_name = $projectName;
        $advertLot->project_status = $request->project_status;
        $advertLot->plan_advert_id = $request->advert_id;
        $advertLot->package_no = $request->package_no;
        $advertLot->lot_no = $request->lot_no;
        $advertLot->description = $request->description;
        $advertLot->advert_lot_business_category_id = $request->lot_category;
        $advertLot->category_name = $category[0]->name;
        $advertLot->lot_amount = $request->lot_amount;
        $advertLot->user_id = $user->id;
        $advertLot->cell_position = $request->cell_position;

        $position = $request->cell_position;
        if($request->has('tender_document')){
            $file = $request->tender_document;
            $filenamewithoutext = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = $filenamewithoutext.'_'.time().'.'.$extension;
            $directory = 'uploads/'.$filename;
            $uploaded = Storage::disk('s3')->put( $directory,  file_get_contents($file) , 'public');
            if($uploaded) {
                $url = $uploaded;
                $advertLot->tender_document = $directory;
            }
        }
        
        if($request->has('tender_document_inhouse')){
            $file = $request->tender_document_inhouse;
            $filenamewithoutext = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = $filenamewithoutext.'_'.time().'.'.$extension;
            $directory = 'uploads/'.$filename;
            $uploaded = Storage::disk('s3')->put( $directory,  file_get_contents($file) , 'public');
            if($uploaded) {
                $url = $uploaded;
                $advertLot->tender_document_inhouse = $directory;
            }
        }

        $advertLot->save();
        
        // TODO: Read value from excel file 
        Excel::import(new ImportTenderDocumentInHouse($position, $advertLot), $request->tender_document_inhouse);
       
    }

}
