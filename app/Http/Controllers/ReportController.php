<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\QueryException;
use App\ContractorFile;
use Illuminate\Support\Facades\Auth;

use App\Repositories\Compliance\ComplianceContract;
use App\Repositories\Director\DirectorContract;
use App\Repositories\ContractorPersonnel\ContractorPersonnelContract;
use App\Repositories\ContractorCategory\ContractorCategoryContract;
use App\Repositories\ContractorJobs\ContractorJobsContract;
use App\Repositories\ContractorFinance\ContractorFinanceContract;
use App\Repositories\ContractorMachinery\ContractorMachineryContract;
use App\Repositories\Contractor\ContractorContract;
use App\User;
use App\Contractor;

class ReportController extends Controller
{
    protected $repo;
    protected $director;
    protected $personel;
    protected $category;
    protected $jobs;
    protected $finance;
    protected $machinery;
    protected $contractor;

    public function __construct(
        ContractorCategoryContract $contractorCategoryContract, 
        ContractorPersonnelContract $contractorPersonnelContract,
        ComplianceContract $complianceContract, 
        DirectorContract $directorContract, 
        ContractorJobsContract $contractorJobsContract, 
        ContractorFinanceContract $contractorFinanceContract,
        ContractorMachineryContract $contractorMachineryContract,
        ContractorContract $contractorContract
    )
    {
        $this->repo = $complianceContract;
        $this->director = $directorContract;
        $this->personel = $contractorPersonnelContract;
        $this->category = $contractorCategoryContract;
        $this->jobs = $contractorJobsContract;
        $this->finance = $contractorFinanceContract;
        $this->machinery = $contractorMachineryContract;
        $this->contractor = $contractorContract;
    }

    public function contractors(){
        $this->middleware('auth');
        try {
            $getContractors = Contractor::with('user')->get();
           // dd($getContractors);

            if ($getContractors) {
                // return response()->json(['success'=> $getCompliance], 200);
                return view('admin.contractors', ['contractors' => $getContractors]);
            }
            else {
                return response()->json(['responseText' => 'Error retriving contractor compliance'], 500);
            }
            
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
        
    }

    public function contractorPreview(Request $request, $id){
        $this->middleware('auth');
        try {
            $directors = $this->director->find($id);
            $personel = $this->personel->find($id);
            $categories = $this->category->find($id);
            $jobs = $this->jobs->find($id);
            $financies = $this->finance->find($id);
            $machineries = $this->machinery->find($id);
            $contractors = $this->contractor->find($id);
            $getUploadfiles = ContractorFile::where('user_id', $id)->get();
            // if(!$contractors) {
            //     $notification = array(
            //         'message' => 'Incomplete Company Profile', 
            //         'alert-type' => 'error'
            //         );
            //     return redirect()->back()->with($notification);
            // }
            
            return view('admin/contractors_preview',[
                'directors' => $directors, 
                'personel' => $personel, 
                'categories' => $categories, 
                'jobs' => $jobs,
                'financies' => $financies,
                'machineries' => $machineries,
                'getUploadfiles' => $getUploadfiles,
                'contractors' => $contractors
                ]);
            
            
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
       
    }

    public function evaluatorContractorPreview(Request $request, $id){
        if (!$request->session()->has('evaluator_id')) {
            return redirect('/');
        }
        try {
            $directors = $this->director->find($id);
            $personel = $this->personel->find($id);
            $categories = $this->category->find($id);
            $jobs = $this->jobs->find($id);
            $financies = $this->finance->find($id);
            $machineries = $this->machinery->find($id);
            $contractors = $this->contractor->find($id);
            $getUploadfiles = ContractorFile::where('user_id', $id)->get();
            return view('evaluator/contractors_preview',[
                'directors' => $directors, 
                'personel' => $personel, 
                'categories' => $categories, 
                'jobs' => $jobs,
                'financies' => $financies,
                'machineries' => $machineries,
                'getUploadfiles' => $getUploadfiles,
                'contractors' => $contractors
                ]);
        } catch (QueryException $e) {
            return response()->json(['response' => $e->getMessage()], 500);
        }
    }
}
