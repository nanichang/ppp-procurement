<?php

namespace App\Repositories\Director;

use App\Director;
use App\User;
use App\Repositories\Director\DirectorContract;
use Illuminate\Support\Facades\Auth;
use Session;


class EloquentDirectorRepository implements DirectorContract{

    public function createDirector($request) {  
        $director = new Director;
       
        if(1 === preg_match('~[0-9]~', $request->first_name)){
            return 'Invalid First Name';
        }
        else if(1 === preg_match('~[0-9]~', $request->last_name)){
            return 'Invalid Last Name';
        }
        $this->setDirectorProperties($director, $request);
        $director->save();
        return 1;
        
        
    }

    public function find($id)
    {
       return Director::where('user_id', $id)->get();
    }


    public function getCompanyDirectors() {
        return Director::where("user_id", Auth::user()->id)->get();
    }

    public function removeDirector($request){ 
        $data = $request['ids'];
        try {
            for($i=0; $i<sizeof($data); $i++){
                $tmp = Director::where('id', $data[$i] )->delete();
            }
        }
        catch(\Exception $e) {
            return false;
        }
        return true;
    }

    private function setDirectorProperties($director, $request) {
          //$user = Auth::user();
          //dd($request);
        $director->first_name = $request->first_name;
        $director->last_name = $request->last_name;
        $director->gender= $request->gender;
        $director->nationality = $request->nationality;
        $director->country = $request->country;
        $director->identification = $request->identification;
        $director->membership_id_no = $request->membership_id_no;
        $director->professional_membership = $request->professional_membership;
        $director->user_id = Auth::user()->id;
    }


}


?>