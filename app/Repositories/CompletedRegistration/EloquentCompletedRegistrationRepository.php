<?php
namespace App\Repositories\CompletedRegistration;

use App\CompletedRegistration;
use App\CategoryRegistrationFee;

use App\Director;
use App\ContractorCategory;
use App\ContractorJobs;
use App\ContractorFinance;
use App\ContractorPersonnel;
use App\ContractorMachinery;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\ContractorRegistration;
use App\Contractor;

class EloquentCompletedRegistrationRepository implements CompletedRegistrationContract
{
    public function create($request){
        $userId = Auth::user()->id;
        $directors = Director::where('user_id', $userId)->get();
        $category = ContractorCategory::where('user_id', $userId)->get();
        $jobs = ContractorJobs::where('user_id', $userId)->get();
        $finance = ContractorFinance::where('user_id', $userId)->get();
        $personnels = ContractorPersonnel::where('user_id', $userId)->get();
        $machinery = ContractorMachinery::where('user_id', $userId)->get();

        
        if($directors->count() < 1 || $category->count() < 1 || $jobs->count() < 1 || $finance->count() < 1 
            || $personnels->count() < 1 || $machinery->count() < 1 ){

            return 'Sorry, You \'ve to Finish Previous Tabs before Finishing';
        }

        $totalAmount = 0;
        $data = CategoryRegistrationFee::find($request->catId);
        foreach($data as $data) {
 
            $found = CompletedRegistration::where('user_id', $userId)
                ->where('category_id', $data->id)->get();
    
            if($found->count() > 0){
                return 'You ve Already Registered for '.$data->description. ' Category';
            }
             
            $currentDate = Carbon::now();
            $register =  new CompletedRegistration;
            $register->company_name = Auth::user()->name;
            $register->registration_category = $data->name;
            $register->category_id = $data->id;
            $register->description = $data->description;
            $register->expiration_date =  $currentDate->addYear()->toDateTimeString();
            $register->renewal_amount = $data->renewal_fee;
            $register->amount = $data->amount;
            $register->user_id = $userId;
            $register->registration_id = Auth::user()->registration_id;
            $register->save();
            $totalAmount += (float) $register->amount;

        }
        $contractor = Contractor::where('user_id', Auth::user()->id)->first();
        $cr = new ContractorRegistration;
        $cr->contractor_id = $contractor->id;
        $cr->amount = $totalAmount;
        $cr->save();

        return 1;
    }

    public function listAllRegistrations(){
        return CompletedRegistration::select('user_id')->distinct()->get();
    }
    
    
    public function getRegistrationsByUserId(){
        return CompletedRegistration::where('user_id', Auth::user()->id)->get();
    }


    public function getRegistrationsById($id){
        return CompletedRegistration::find($id);
    }
    
    
}