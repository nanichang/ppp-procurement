<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\QueryException;

use App\Repositories\Equipments\EquipmentContract;

class EquipmentController extends Controller
{
    protected $repo;

    public function __construct(EquipmentContract $equipmentContract){
         $this->middleware('auth');
        $this->repo = $equipmentContract;
    }

    public function index() {
        try {
            $equipments = $this->repo->listEquipments();

            if ($equipments) {
                return view('admin.tools.equipments', ['equipments' => $equipments]);
            }
            else {
                return response()->json(['responseText' => 'Error retriving Equipments type'], 500);
            }
            
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
       
    }

    public function storeEquipments(Request $request) {

        try {
            $data = $request->all();
            // dd($data);
            $equipments = $this->repo->create($data);

            if ($equipments) {
                return redirect()->back()->with('success', 'Equipments Type Added Succesfully.');
                // return response()->json(['success'=>'Equipments Type Added Succesfully.'], 200);
            }
            else {
                return response()->json(['responseText' => 'Error adding Equipments type'], 500);
            }
            
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
    }

    public function getEquipmentsType() {

        try {
            $equipments = $this->repo->listEquipments();

            if ($equipments) {
                return response()->json(['success'=> $equipments], 200);
            }
            else {
                return response()->json(['responseText' => 'Error retriving Equipments type'], 500);
            }
            
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
    }

    public function delete(Request $request){
        try {
        
            $equipment = $this->repo->destroy($request);

            if ($equipment) {
                
                 return back()->with(['success'=>'Equipment deleted Succesfully.']);
            }
            else {
                return response()->json(['responseText' => 'Error Deleting Equipment'], 500);
            }
            
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
        
    }
}
