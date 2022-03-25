<?php

namespace App\Repositories\ContractorPersonnel;

use App\ContractorPersonnel;
use App\User;
use App\Repositories\ContractorPersonnel\ContractorPersonnelContract;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Session;


class EloquentContractorPersonnelRepository implements ContractorPersonnelContract{

    public function createPersonnel($request) { 
        $personnel = new ContractorPersonnel;

        if(1 === preg_match('~[0-9]~', $request->first_name)){
            return 'Invalid First Name';
        }
        else if(1 === preg_match('~[0-9]~', $request->last_name)){
            return 'Invalid Last Name';
        }
        // else if($request->gender){
        //     return 'Select Gender';
        // }
        else if($request->experience_years < 0){
            return 'Invalid Experience year';
        }
        else if($request->joining_date > Carbon::now()->isoFormat('YYYY-MM-D')){
            return 'Invalid Joining Date';
        }

        else if($request->graduation_year > Carbon::now()->isoFormat('YYYY')){
            return 'Invalid Graduation Year';
        }

        $this->setContractorPersonnelProperties($personnel, $request);
        return $personnel->save();
    }


    public function getPersonnelsById() {
        return ContractorPersonnel::where("user_id", Auth::user()->id)->get();
    }

    public function removePersonnel($request){ 
        $data = $request['pids'];
        try {
            for($i=0; $i<sizeof($data); $i++){
                $tmp = ContractorPersonnel::find($data[$i]);
                $tmp->delete();
            }
            return true;
        }
        catch(\Exception $e){
            return false;
        }
       
    }

    public function find($id)
    {
       return ContractorPersonnel::where('user_id', $id)->get();
    }

    private function setContractorPersonnelProperties($personnel, $request) {
        $user = Auth::user();
        $personnel->first_name = $request->first_name;
        $personnel->last_name = $request->last_name;
        $personnel->gender = $request->gender; 
        $personnel->nationality= $request->nationality;
        $personnel->passport_no = $request->passport_no;
        $personnel->national_id_no = $request->national_id_no;
        $personnel->employment_type = $request->employment_type;
        $personnel->experience_years = $request->experience_years;
        $personnel->joining_date = $request->joining_date;
        $personnel->school_name = $request->school_name;
        $personnel->qualification = $request->qualification;
        $personnel->country = $request->country;
        $personnel->graduation_year = $request->graduation_year;
        $personnel->regulatory_body = $request->regulatory_body;
        $personnel->membership_id_no = $request->membership_id_no;
        $personnel->project_involved = $request->project_involved;
        $personnel->description = $request->description;
        $personnel->user_id = $user->id;

    }


}


?>