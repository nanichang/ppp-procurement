<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\QueryException;
use App\Repositories\AdvertLot\AdvertLotContract;

class AdvertLotController extends Controller{

    protected $repo;

    public function __construct(AdvertLotContract $advertLotContract){
         $this->middleware('auth');
        $this->repo = $advertLotContract;
    }

    public function AdvertLots(){
        $adverts = $this->repo->listAdvertLotsByUserId();
      //  $lots = $this->repo->listAdvertLotsByAdverts();
        return response()->json(['adverts' =>$adverts], 200);
    }


    public function storeAdvertLot(Request $request) {
        try {
            if ($this->repo->createAdvertLot($request)) {
                return response()->json(['success' => 'Record Added Successfully'], 200);
            } else {
                return response()->json(['responseText' => 'Failed to Add Record'], 500);
            }
        } catch (QueryException $e) {
            return response()->json(['response' => $e->getMessage()], 500);
        }
    }

    public function deleteAdvertLot(Request $request) {
        try {
            $advert = $this->repo->removeAdvertLot($request);
            // $adverts = $this->repo->listAdvertLotsByUserId();
            if ($advert) {
                return redirect()->back()->with([
                    'message'=>'Deleted successfully',
                    'alert-type' => 'success'
                ]);
            } else {
                return redirect()->back()->with([
                    'message'=>'Error processing deletion... Please try again.',
                    'alert-type' => 'error'
            ]);
             }
        } catch (QueryException $e) {
            return redirect()->back()->with([
                    'message'=>$e->getMessage(),
                    'alert-type' => 'error'
            ]);
        }
     }


    public function deleteAdvertLotApi(Request $request) {
        try {
            $advert = $this->repo->removeAdvertLot($request);
            // $adverts = $this->repo->listAdvertLotsByUserId();
            if ($advert) {
                return redirect()->back()->with([
                    'message'=>'Deleted successfully',
                    'alert-type' => 'success'
                ]);
            } else {
                return response()->json(['success' => 'failed to delete records'], 500);
             }
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
        }
     }

}
