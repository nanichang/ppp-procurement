<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TenderRequirement\TenderRequirementContract;


class TenderRequirementController extends Controller{
    protected $repo;


    public function __construct(TenderRequirementContract $tenderRequirementContract){
         $this->middleware('auth');
        $this->repo = $tenderRequirementContract;
    }

    public function tenderRequirements(){
        $adverts = $this->repo->listRequirementsByLotId($lotId);
      //  $lots = $this->repo->listAdvertLotsByAdverts();
       // return response()->json(['adverts' =>$adverts], 200);
    }


    public function storeTenderRequirement(Request $request) {
       try {
          // dd($request);
         $response =  $this->repo->createTenderRequirement($request);
        if ($response == 1) {
            $notification = array(
                'message' => 'Requirements Updated Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => $response,
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification)->withInput();
            }
       } catch (\Exception $e) {
           $msg;
           if($e->message() == 'Trying to get property \'id\' of non-object'){
                $msg = 'You Have to Create Lots Before Requirement';
           }
           else {
               $msg = 'Error Occured Please Contact Admin';
           }
        $notification = array(
            'message' => $msg,
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification)->withInput();
       }
    }


    // public function deleteAdvertLot(Request $request) {
    //     try {
    //         $advert = $this->repo->removeAdvertLot($request);
    //         $adverts = $this->repo->listAdvertLotsByUserId();
    //         if ($advert) {
    //             return response()->json(['success' => 'records deleted successfully'], 200);
    //             //return view('mda.createAdvert', ['adverts' => $adverts]);
    //         } else {
    //             return response()->json(['success' => 'failed to delete records'], 500);
    //          }
    //     } catch (QueryException $e) {
    //      return response()->json(['response' => $e->getMessage()], 500);
    //     }
    //  }

}
