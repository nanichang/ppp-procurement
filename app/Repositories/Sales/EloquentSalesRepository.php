<?php
namespace App\Repositories\Sales;

use App\Sales;
use App\AdvertLot;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Contractor;
use App\Mda;
use Storage;
use App\Imports\ImportContractorTenderDocument;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;


class EloquentSalesRepository implements SalesContract
{
    public function create($request){

        $data = $request->fids;
        $user = Auth::user();
        $contractor = Contractor::where('user_id', $user->id)->first();
        $mda = Mda::find($request->mda_id);
        
        for( $i = 0; $i<sizeof($data); $i++) {
            $lot = AdvertLot::with('planAdvert')->where('id', $data[$i])->first();
            $sales = new Sales();
            $sales->advert_lot_id =  $data[$i];
            $sales->lot_description = $lot->description;
            $sales->advert_id = $lot->plan_advert_id;
            $sales->amount = $lot->lot_amount;
            $sales->advert_name = $request->advert_name;
            $sales->advert_introduction = $request->advert_introduction;
            $sales->mda_id = $request->mda_id;
            $sales->mda_name = $mda->name;
            $sales->user_id = $user->id;
            $sales->user_name = $user->name;
            $sales->payment_status = 'pending';
            $sales->transaction_id = (rand(1, 10000).rand(1, 10000));
            $sales->contractor_id = $contractor->id;
            $sales->contractor_name = $contractor->company_name;
            $sales->bid_opening_date = $lot->planAdvert->bid_opening_date;
            $sales->closing_date = $lot->planAdvert->closing_date;
            $sales->passed_evaluation = false;
            $sales->save();
        }
        return $sales;
    }

    public function find($id)
    {
       return Sales::find($id);
    }


    public function listSales()
    {
        return Sales::all();
    }

    public function listSalesByUserId()
    {
        return Sales::with('awards')->where('user_id', Auth::user()->id)
            ->orderBy('payment_status', 'desc')
            ->get();
    }

    public function listSalesByUserandAdvertId($advertId){
        return Sales::with('awards')->where('advert_id', $advertId)
            ->where('user_id', Auth::user()->id)
             ->orderBy('created_at', 'desc')->get();
    }

    public function getMDATransactions() {
        $mda = Mda::where('email', Auth::user()->email)->first();
        return Sales::with('awards')->where('mda_id', $mda->id)
        ->orderBy('payment_status', 'desc')
        ->get();
    }

    public function mySales() {
        return Sales::with('awards')->where('user_id', Auth::user()->id)
       ->where('payment_status', 'paid')
       ->sum('amount');
    }


    public function totalSales() {
        return Sales::all()->count();
    }

    public function salesCount(){
        return Sales::where('user_id', Auth::user()->id)->count();
    }

    public function submittedApplications(){
         return Sales::with('awards')->where('user_id', Auth::user()->id)
         ->distinct('advert_lot_id')
         ->count('advert_lot_id');

    }

    public function getPassedByLot($id){
        return Sales::with('awards')->where('advert_lot_id', $id)->where('passed_evaluation', true)
        // ->orderBy('created_at', 'desc')
        ->get();
    }
    
    public function getSubmittionsByMDAId($id){
        return Sales::with('awards')->where('mda_id', $id)
        // ->where('status', '!=', 'pending')
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public function getSubmittionsByMDA(){
        return Sales::with('awards')->where('user_id', Auth::user()->id)
        ->orderBy('created_at', 'desc')
        ->get();
    }


    public function destroy($id)
    {
        $client = Sales::findorFail($id);
        return $client->delete();
    }

    public function update($id, $requestData)
    {
        return Sales::find($id)->update($requestData);
    }

    public function updatePaymentStatus($id) {
        $payment = Sales::where('id', $id)->firstOrFail();
        $payment->payment_date = Carbon::now()->isoFormat('DD-MM-YYYY HH:mm:ss');
        if ($payment->payment_status == 'Paid') {
            $payment->payment_status = 'Pending';
        }
        else {
            $payment->payment_status = 'Paid';
        }
        return $payment->save();
    }


    public function listSalesByUser(){
        return Sales::with('advertLot')->with('awards')->where('user_id', Auth::user()->id)->where('payment_status', 'Paid')
            ->orderBy('created_at', 'desc')->get();
    }

    public function storeReport($request, $evaluator) {
        $sale = $this->find($request->sale_id);
        $sale->report = $request->report;
        $sale->reported_by = $evaluator->name;
        $sale->passed_evaluation = true;
        return $sale->save();        
    }

    
    public function viewAllSubmiitedSales($advertId, $advertLotId = null, $evaluator = null){
        if($advertLotId){
            if($evaluator){
                return Sales::with('advertLot')->with(['evaluatorLotEvaluations' => function($q) use ($evaluator){
                    if($evaluator->user_type == 'user'){
                        $q->with('advertCriteria')->where('evaluator_id', $evaluator->id);
                    }
                }])->where('advert_id', $advertId)
                ->where('advert_lot_id', $advertLotId)
                ->orderBy('created_at', 'desc')->get();
            }else{
                return Sales::with('advertLot')->with('evaluatorLotEvaluations')->where('advert_id', $advertId)
                ->where('advert_lot_id', $advertLotId)
                ->orderBy('created_at', 'desc')->get();
            }
        }
        return Sales::with('advertLot')->where('advert_id', $advertId)
             ->orderBy('created_at', 'desc')->get();
    }
    
    public function viewSingleSubmitedSaleByAdvertLotId($advertId){
        return Sales::with('contractor')->with('advertLot')->with('planAdvert')->with('evaluatorLotEvaluations')->where('advert_lot_id', $advertId)
             ->orderBy('created_at', 'desc')->first();
    }

    public function uploadPaymentDocument($request) {
        
        $sale = Sales::find($request->sale_id);
        if($request->has('payment_document')){
            $file = $request->payment_document;
            $filenamewithoutext = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = $filenamewithoutext.'_'.time().'.'.$extension;
            $directory = 'uploads/'.$filename;
            $uploaded = Storage::disk('s3')->put( $directory,  file_get_contents($file) , 'public');
            if($uploaded) {
                $sale->payment_document = $directory;                
            }
        }
        return $sale->save();        
    }
    
    public function uploadContractorTenderDocument($request) {
        $user = Auth::user();
        $contractor = Contractor::where('user_id', $user->id)->first();

        $sale = Sales::with('advertLot')->where('advert_lot_id', $request->advert_lot_id)->where('contractor_id', $contractor->id)->first();
        $sale->contractor_bid_amount = $request->contractor_bid_amount;
        
        
        

        if($request->has('contractor_tender_document')){
            $file = $request->contractor_tender_document;
            $filenamewithoutext = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = $filenamewithoutext.'_'.time().'.'.$extension;
            $directory = 'uploads/'.$filename;
            $uploaded = Storage::disk('s3')->put( $directory,  file_get_contents($file) , 'public');
            if($uploaded) {
                $sale->contractor_tender_document = $directory;                
            }
        }
        // dd($sale);
        Excel::import(new ImportContractorTenderDocument($sale->advertLot->cell_position, $sale), $request->contractor_tender_document);
        $sale->variation = $sale->advertLot->inhouse_bid_amount - $sale->contractor_bid_amount;
        $sale->save();        
    }

    public function awardContractToContractor($request) {
        DB::beginTransaction();
        try{
            $allAwardedPlans = Sales::where('advert_lot_id', $request->advert_lot_id)
                ->where('is_awarded', true)->get();        
            foreach($allAwardedPlans as $awardedPlan) {
                $awardedPlan->is_awarded = false;
                $awardedPlan->save();
            }
            $sale = Sales::where('contractor_id', $request->contractor_id)
                ->where('advert_lot_id', $request->advert_lot_id)->first();
            $sale->is_awarded = true;
            $sale->report = $request->report;
            $sale->reported_by = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            $sale->save();
            DB::commit();
            return 1;
        }catch(\Exception $e){
            DB::rollback(); 
            return 0;
        }
    }
}
