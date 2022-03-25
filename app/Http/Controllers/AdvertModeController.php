<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AdvertMode\AdvertModeContract;
use App\Repositories\AdvertType\AdvertTypeContract;

use App\AdvertType;
use App\AdvertMode;

class AdvertModeController extends Controller{
    protected $repo;
    protected $advertType;

    public function __construct(AdvertModeContract $advertModeContract, AdvertTypeContract $advertTypeContract){
         $this->middleware('auth');
         $this->repo = $advertModeContract;
         $this->advertType = $advertTypeContract;
    }

    public function index() { 
        try {
            $advertTypes = $this->advertType->allAdvertTypes();
            $modes = $this->repo->allAdvertModes();

            if ($modes) {
                return view('admin.tools.advertMode', ['advertModes' => $modes, 'advertTypes' => $advertTypes]);
            }
            else {
                return view('admin.tools.advertMode', ['advertModes' => $modes, 'advertTypes' => $advertTypes]);
            }
            
        } catch (QueryException $e) {
            return view('admin.tools.advertMode', ['advertModes' => $modes]);
 
        }
       
    }

    public function storeAdvertMode(Request $request) {

        try {
            $data = $request->all();
            $advert= $this->repo->createAdvertMode($data);
            $advertModes= $this->repo->allAdvertModes();
            $advertTypes = $this->advertType->allAdvertTypes();

            if ($advert) {
                return redirect()->route('fetchAdvertModes')->with(['advertModes' => $advertModes, 'advertTypes' => $advertTypes]);
            }
            else {
                return redirect()->route('fetchAdvertModes')->with(['advertModes' => $advertModes, 'advertTypes' => $advertTypes]);
            }
            
        } catch (Exception $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
    }

    public function delete(Request $request){

        try {
            $advertMode = $this->repo->destroy($request);
            $advertModes = $this->repo->listAllAdvertModes();
            $advertTypes = $this->advertType->allAdvertTypes();

            if ($advertMode) {
                return redirect()->route('fetchAdvertModes')->with(['advertModes' => $advertModes, 'advertTypes' => $advertTypes]);
            }
            else {
                return redirect()->route('fetchAdvertModes')->with(['advertModes' => $advertModes, 'advertTypes' => $advertTypes]);
            }
            
        } 
        catch (Exception $e) {
            return response()->json(['response' => $e->getMessage()], 500);
        }
        
    }

    public function getAllAdvertModes() {

        $rawVehicleMakes = AdvertType::get(['id', 'name']);
        $vehicleMakes = ['default' => "Select Advert Type"];

        for ($i=0; $i < count($rawVehicleMakes); $i++) {
            $vehicleMakes[$rawVehicleMakes[$i]->id] = $rawVehicleMakes[$i]->name;
        }

        $rawVehicleModels = AdvertMode::orderBy('name', 'ASC')->get(['id', 'name', 'advert_type_id']);
        $vehicleModels = ['default' => "Select Advert Mode"];

        $jsArray = '{';

        for ($i=0; $i < count($rawVehicleMakes); $i++) {
            $buffer = '';
            for ($j=0; $j < count($rawVehicleModels); $j++) { 
                if ($rawVehicleMakes[$i]->id == $rawVehicleModels[$j]->advert_type_id) {
                    $buffer .= json_encode($rawVehicleModels[$j]) . ',';
                }
            }
            $jsArray .= $rawVehicleMakes[$i]->id . ':[' . $buffer . '],';
        }

        $jsArray .= '}';
    }
}
