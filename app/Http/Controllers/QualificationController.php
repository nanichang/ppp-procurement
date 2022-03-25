<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\QueryException;

use App\Repositories\Qualifications\QualificationContract;

class QualificationController extends Controller
{
    protected $repo;

    public function __construct(QualificationContract $qualificationContract){
         $this->middleware('auth');
        $this->repo = $qualificationContract;
    }

    public function index() {
        try {
            $qualification = $this->repo->listQualifications();

            if ($qualification) {
                return view('admin.tools.qualifications', ['qualification' => $qualification]);
            }
            else {
                return response()->json(['responseText' => 'Error retriving Equipments type'], 500);
            }
            
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
       
    }

    public function storeQualifications(Request $request) {

        try {
            $data = $request->all();
            $qualification = $this->repo->create($data);

            if ($qualification) {
                return redirect()->back()->with('success', 'Qualification Added Succesfully.');
                // return response()->json(['success'=>'Qualifications Added Succesfully.'], 200);
            }
            else {
                return response()->json(['responseText' => 'Error adding qualifications'], 500);
            }
            
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
    }

    public function getQualifications() {

        try {
            $qualification = $this->repo->listQualifications();

            if ($qualification) {
                return response()->json(['success'=> $qualification], 200);
            }
            else {
                return response()->json(['responseText' => 'Error retriving Qualifications'], 500);
            }
            
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
    }

    public function delete(Request $request){
        try {
        
            $qualification = $this->repo->destroy($request);

            if ($qualification) {
                
                 return back()->with(['success'=>'Qualification deleted Succesfully.']);
            }
            else {
                return response()->json(['responseText' => 'Error adding Company Ownership'], 500);
            }
            
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
        
    }
}
