<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\QueryException;

use App\Repositories\BusinessCategory\BusinessCategoryContract;
use App\BusinessCategory;
use App\BusinessSubCategory1;

class BusinessCategoryController extends Controller{
    protected $repo;

    public function __construct(BusinessCategoryContract $categoryContract){
         $this->middleware('auth');
        $this->repo = $categoryContract;
    }

    public function index() { 
        try {
            $categories = $this->repo->allBusinessCategories();

            if ($categories) {
                return view('admin.tools.businessCategory', ['categories' => $categories]);
            }
            else {
                return view('admin.tools.businessCategory', ['categories' => $categories]);
            }
            
        } catch (QueryException $e) {
            return view('admin.tools.businessCategory', ['categories' => $categories]);
 
        }
       
    }

    public function storeBusinessCategory(Request $request) {

        try {
            $data = $request->all();
            $category= $this->repo->createBusinessCategory($data);
            $categories = $this->repo->allBusinessCategories();
            if ($category) {
                return redirect()->route('fetchBusinessCategories')->with(['categories' => $categories]);
            }
            else {
                return redirect()->route('fetchBusinessCategories')->with(['categories' => $categories]);
            }
            
        } catch (Exception $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
    }

    public function delete(Request $request){

        try {
            $category = $this->repo->destroy($request);
            $categories = $this->repo->listAllBusinessCategories();
            if ($category) {
                return redirect()->route('fetchBusinessCategories')->with(['categories' => $categories]);
            }
            else {
                return redirect()->route('fetchBusinessCategories')->with(['categories' => $categories]);
            }
            
        } 
        catch (Exception $e) {
            return redirect()->route('fetchBusinessCategories')->with(['categories' => $categories]);

 
        }
        
    }

    public function getAllBusinessCategories() {

        $rawVehicleMakes = BusinessCategory::get(['id', 'name']);
        $vehicleMakes = ['default' => "Select a Category"];

        for ($i=0; $i < count($rawVehicleMakes); $i++) {
            $vehicleMakes[$rawVehicleMakes[$i]->id] = $rawVehicleMakes[$i]->name;
        }

        $rawVehicleModels = BusinessSubCategory1::orderBy('name', 'ASC')->get(['id', 'name', 'business_category_id']);
        $vehicleModels = ['default' => "Select Sub-Category"];

        $jsArray = '{';

        for ($i=0; $i < count($rawVehicleMakes); $i++) {
            $buffer = '';
            for ($j=0; $j < count($rawVehicleModels); $j++) { 
                if ($rawVehicleMakes[$i]->id == $rawVehicleModels[$j]->business_category_id) {
                    $buffer .= json_encode($rawVehicleModels[$j]) . ',';
                }
            }
            $jsArray .= $rawVehicleMakes[$i]->id . ':[' . $buffer . '],';
        }

        $jsArray .= '}';

        // try {
        //     $categories = $this->repo->listAllBusinessCategories();

        //     if ($categories) {
        //         return response()->json(['success'=> $categories], 200);
        //     }
        //     else {
        //         return response()->json(['responseText' => 'Error retriving Business Categories'], 500);
        //     }
            
        // } catch (QueryException $e) {
        //  return response()->json(['response' => $e->getMessage()], 500);
 
        // }
    }
}
