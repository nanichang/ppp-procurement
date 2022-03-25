<?php
namespace App\Repositories\Award;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Storage;
use App\Award;
use App\AdvertLot;
use App\Evaluator;
use App\Sales;
use Queue;
use App\Console\Commands\DispatchAwardNotificationsCommand;
use App\Mail\AwardNotificationContractorMail;
use App\Contractor;

class EloquentAwardRepository implements AwardContract {

    public function createAward($request) {
        if (!$request->session()->has('evaluator_id')) {
            return redirect('/');
        }
        $id = $request->session()->get('evaluator_id', null);
        $evaluator = Evaluator::find($id);
        if($evaluator->user_type != 'mda'){
            throw new \Exception("Only the evaluator admin can approve awards");
        }
        $advertLot = AdvertLot::with('planAdvert')->where('id',$evaluator->advert_lot_id)->first();
        $sales = Sales::find($request->sales_id);
        $award = new Award();
        $award->comment = $request->comment;
        $award->plan_advert_id = $advertLot->plan_advert_id;
        $award->advert_lot_id = $advertLot->id;
        $award->evaluator_admin_id = $evaluator->id;
        $award->contractor_id = $sales->contractor_id;
        $award->sales_id = $sales->id;
        $award->mda_id = $evaluator->mda_id;
        return $award->save();
    }


    public function approveAward($request, $id){
        $user = Auth::user();
        if($user->user_type != 'admin'){
            throw new \Exception("Only the admin can approve awards");
        }
        $award = Award::find($id);
        if($award->status == 'pending'){
            $award->status = 'approved';
            $award->approval_date = Carbon::now();
        }else if($award->status == 'approved'){
            if($award->user_id != $user->id){
                throw new \Exception("Only the account that approves can revert the process");
            }
            $award->status = 'pending';
        }else{
            throw new \Exception("A cancelled or an accepted award cannot be approved");
        }
        $award->user_id = $user->id;
        $award->approval_comment = $request->approval_comment;
        
        if($request->has('uploaded_approval_file')){
            $file = $request->uploaded_approval_file;
            $filenamewithoutext = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = $filenamewithoutext.'_'.time().'.'.$extension;
            $directory = 'uploads/'.$filename;
            $uploaded = Storage::disk('s3')->put( $directory,  file_get_contents($file) , 'public');
            if($uploaded) {
                $url = $uploaded;
                $award->uploaded_approval_file = $directory;
            }
        }
        return $award->save();
    }

    public function awardNotification($request, $id){
        if (!$request->session()->has('evaluator_id')) {
            return redirect('/');
        }
        $seid = $request->session()->get('evaluator_id', null);
        $award = Award::with('contractor')->with('sales')->find($id);
        $evaluator = Evaluator::find($award->evaluator_admin_id);
        if($evaluator->user_type != 'mda' && $evaluator->id != $seid){
            throw new \Exception("Only the evaluator admin who was assigned to this lot can generate award letter");
        }
        // Dispatch Award Notifications
        // $sales = Sales::with('contractor')->where('advert_lot_id', $award->advert_lot_id)->get();
        try {
            Mail::to($this->award->contractor->email)->send(new AwardNotificationContractorMail(
                $this->award->contractor->company_name,
                $this->award->award_letter_comment
            ));
            $award->award_notification_sent = true;
            $award->award_letter_comment = $request->award_letter_comment;
            $award->save();
        } catch (\Exception $th) {
            throw new \Exception('Unable to send notification');
        }
        // foreach ($sales as $sale) {
        //     Queue::push(new DispatchAwardNotificationsCommand($sale, $award));   
        // }
        return $award;
    }

    public function uploadAwardLetter($request, $id){
        // $user = Auth::user();
        // if($user && $user->user_type != 'mda' && ){
        //     throw new \Exception("Only the mda can approve awards");
        // }
        if (!$request->session()->has('evaluator_id')) {
            return redirect('/');
        }
        $seid = $request->session()->get('evaluator_id', null);
        $award = Award::find($id);
        $evaluator = Evaluator::find($award->evaluator_admin_id);
        if($evaluator->user_type != 'mda' && $evaluator->id != $seid){
            throw new \Exception("Only the evaluator admin who was assigned to this lot can generate award letter");
        }
        $award->award_letter_date = Carbon::now();
        $award->status = 'awarded';
        
        // if(!$request->has('uploaded_award_file')){
        //     throw new \Exception("Award letter is compulsory");
        // }

        // $file = $request->uploaded_award_file;
        // $filenamewithoutext = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        // $extension = $file->getClientOriginalExtension();
        // $filename = $filenamewithoutext.'_'.time().'.'.$extension;
        // $directory = 'uploads/'.$filename;
        // $uploaded = Storage::disk('s3')->put( $directory,  file_get_contents($file) , 'public');
        // if($uploaded) {
        //     $url = $uploaded;
        //     $award->uploaded_award_file = $directory;
        // }

        return $award->save();
    }

    public function cancellAward($request, $id) {
        $user = Auth::user();
        if($user->user_type != 'admin'){
            throw new \Exception("Only the admin can cancel request for awards");
        }
        $award = Award::find($id);
        if($award->status != 'pending'){
            throw new \Exception("It's not possible to do this."); 
        }
        $award->status = 'cancelled';
        $award->cancellation_date = Carbon::now();
        return $award->save();
    }

    public function acceptAward($request, $id) {
        $user = Auth::user();
        if($user->user_type != 'Contractor'){
            throw new \Exception("Only a contractor can accept awards");
        }
        $contractor = Contractor::where('user_id', $user->id)->first();
        $award = Award::find($id);

        if($award->contractor_id != $contractor->id){
            throw new \Exception("Only the contractor given the awards can accept");
        }

        if($award->status == 'accepted'){
            throw new \Exception("Award already accepted. Please contact the admin");
        }

        if($award->status != 'awarded'){
            throw new \Exception("This contract must be awarded before acceptance");
        }

        if(!$request->has('uploaded_acceptance_file')){
            throw new \Exception("Acceptance letter is compulsory");
        }

        $award->status = "accepted";
        $award->acceptance_date = Carbon::now();

        $file = $request->uploaded_acceptance_file;
        $filenamewithoutext = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $filename = $filenamewithoutext.'_'.time().'.'.$extension;
        $directory = 'uploads/'.$filename;
        $uploaded = Storage::disk('s3')->put( $directory,  file_get_contents($file) , 'public');
        if($uploaded) {
            $url = $uploaded;
            $award->uploaded_acceptance_file = $directory;
        }
        return $award->save();
    }

}
