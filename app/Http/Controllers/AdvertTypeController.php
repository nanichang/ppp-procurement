<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdvertType;
use App\Repositories\AdvertType\AdvertTypeContract;

class AdvertTypeController extends Controller {
    protected $repo;

    public function __construct(AdvertTypeContract $advertTypeContract){
        $this->middleware('auth');
        $this->repo = $advertTypeContract;
    }

    public function index() { 
        try {
            $types = $this->repo->allAdvertTypes();

            if ($types) {
                return view('admin.tools.advertType', ['advertTypes' => $types]);
            }
            else {
                return view('admin.tools.advertType', ['advertTypes' => $types]);
            }
            
        } catch (QueryException $e) {
            return response()->json(['response' => $e->getMessage()], 500);
        }
       
    }

    public function storeAdvertType(Request $request) {
        try {
            $data = $request->all();
            $advert= $this->repo->createAdvertType($data);
            $advertTypes = $this->repo->allAdvertTypes();
            if ($advert) {
                return redirect()->route('fetchAdvertTypes')->with(['advertTypes' => $advertTypes]);
            }
            else {
                return redirect()->route('fetchAdvertTypes')->with(['advertTypes' => $advertTypes]);
            }
            
        } catch (Exception $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
    }

    public function delete(Request $request){

        try {
            $advertType = $this->repo->destroy($request);
            $advertTypes = $this->repo->listAllAdvertTypes();
            if ($advertType) {
                return redirect()->route('fetchAdvertTypes')->with(['advertTypes' => $advertTypes]);
            }
            else {
                return redirect()->route('fetchAdvertTypes')->with(['advertTypes' => $advertTypes]);
            }
            
        } 
        catch (Exception $e) {
            return response()->json(['response' => $e->getMessage()], 500);
        }
        
    }

    public function getAllAdvertTypes() {

        $rawVehicleMakes = AdvertType::get(['id', 'name']);
        $vehicleMakes = ['default' => "Select a Category"];

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
