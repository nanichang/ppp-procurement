<?php

namespace App\Repositories\ContractorJobs;

use App\ContractorJobs;
use App\BusinessCategory;
use App\BusinessSubCategory1;
use App\BusinessSubCategory2;
use App\User;
use App\Repositories\ContractorJobs\ContractorJobsContract;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;


class EloquentContractorJobsRepository implements ContractorJobsContract{

    public function createJob($request) { 
        $contractorjob = new ContractorJobs;

        if(strlen($request->contact_phone) > 11  || strlen($request->contact_phone) < 11 ) {

            return  'Invalid Phone Number';
        }
        else  if($request->award_date > Carbon::now()->isoFormat('YYYY-MM-D')) {
            return 'Invalid Award Date';
        }
        else if($request->amount < 1) {
            return 'Invalid Contract Amount';
        }

        $this->setContractorJobsProperties($contractorjob, $request);
        $contractorjob->save();
        return 1;
    }

    public function getJobsById() {
        return ContractorJobs::where("user_id", Auth::user()->id)->get();
    }

    public function getJobsByIdandCategory($category) {
        return ContractorJobs::where([
            'user_id' => Auth::user()->id,
            'categoryId' => $category
            ])->get();
    }


    public function removeJob($request){ 
        $data = $request['jids'];
        try {
            for($i=0; $i<sizeof($data); $i++){
                $tmp = ContractorJobs::find($data[$i]);
                $tmp->delete();
            }
            return true;

        }
        catch(\Exception $e){
            return false;
        }
    }

    private function setContractorJobsProperties($contractorjob, $request) {
        $user = Auth::user();

        $category = BusinessCategory::where('id', $request->business_category_id )->first();
        $category1 = BusinessSubCategory1::where('id', $request->sub_category )->first();

        $contractorjob->job_category = $category->name;
        $contractorjob->categoryId = $category->id;
        $contractorjob->sub_category = $category1->name;
        $contractorjob->sub_categoryId = $category1->id;
        $contractorjob->job_title= $request->job_title;
        $contractorjob->job_description = $request->job_description;
        $contractorjob->client = $request->client;
        $contractorjob->contact_phone = $request->contact_phone;
        $contractorjob->award_date = $request->award_date;
        $contractorjob->amount = $request->amount;  
        $contractorjob->user_id = $user->id;

    }

    public function find($id)
    {
       return ContractorJobs::where('user_id', $id)->get();
    }

}

?>
