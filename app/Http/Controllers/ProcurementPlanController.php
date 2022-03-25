<?php

namespace App\Http\Controllers;

use App\BusinessCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Repositories\ProcurementPlan\ProcurementPlanContract;
use App\Repositories\BusinessCategory\BusinessCategoryContract as PlanCategoryContract;
use Illuminate\Support\Facades\Validator;
use App\ProcurementYear;

class ProcurementPlanController extends Controller
{
    protected $repo;
    protected $planCategoryRepo;
    public function __construct(
        ProcurementPlanContract $procurementPlanContract,
        PlanCategoryContract $planCategoryContract
    ) {
        $this->middleware('auth');
        $this->repo = $procurementPlanContract;
        $this->planCategoryRepo = $planCategoryContract;
    }

    public function index()
    {
        $years = ProcurementYear::paginate(10);
        $plans = $this->planCategoryRepo->listAllBusinessCategories();
        if(getUserRole() == 'admin') {
            return view('procurementplan.index')->with('years', $years)->with('plans', $plans);
        }

        return view('procurementplan.mdaindex')->with('years', $years)->with('plans', $plans);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $year = ProcurementYear::where('active', true)->first();
        $category = BusinessCategory::find($request->plan_type);
        if($request->plan_type == '1') {
            return view('procurementplan.createworks')->with('plan', $request->plan_type)->with('year', $year)->with('category', $category);
        }

        if ($request->plan_type == '2'){
            return view('procurementplan.createconsultancy')->with('plan', $request->plan_type)->with('year', $year)->with('category', $category);
        }

        if ($request->plan_type == '3'){
            return view('procurementplan.creategoods')->with('plan', $request->plan_type)->with('year', $year)->with('category', $category);
        }
    }

    public function createPlan(Request $request)
    {
        // dd($request->all());
        if ($request->isMethod('post')){

            // $validator = Validator::make($request->all(), [
            //     'bid_opening_date'    => 'required|date',
            //     'closing_date'      => 'required|date|after:bid_opening_date',
            // ]);

            // if($validator->fails()) {
            //     return redirect()->back()->with([
            //         'message'=>'Closing date must be a future date.',
            //         'alert-type' => 'error'
            //     ]);
            // }

            try {
                $user = $request->user();
                if(!$user->user_type == "mda"){
                    throw new \Exception("Sorry, only MDAs can create plans");
                }
                $plan = $this->repo->create($request);
                if ($plan == 1) {
                    return redirect()->back()->with([
                        'message'=>'Record Added Successfully',
                        'alert-type' => 'success'
                    ]);
                } else {
                    return redirect()->back()->with([
                        'message'=>'Error saving record... Please try again.',
                        'alert-type' => 'error'
                    ]);
                }
            } catch (QueryException $e) {
                return redirect()->back()->with([
                    'message' => $e->getMessage(),
                    'alert-type' => 'error'
                ]);
            }
        }
    }

    public function viewAll(Request $request, $year)
    {
        // $year = ProcurementYear::find($year);
        $year = ProcurementYear::where('active', 1)->first();
        // dd($year);
        if(isset($_GET['plan_type']) && (int) $_GET['plan_type'] > 0){
            $plans = $this->repo->getPlans((int) $_GET['plan_type'], $year);
            $plan_type = (int) $_GET['plan_type'];
        }else{
            $plan_type = 0;
            $plans = $this->repo->getAllPlans($year);
        }
        $bizCat = BusinessCategory::all();
//        dd($bizCat);

        return view('procurementplan.allsubmissions')->with('plans', $plans)
        ->with('year', $year)
        ->with('plan_type', $plan_type)
        ->with('bizCat', $bizCat);
    }

    public function viewSubmittedPlans($mda_id) {
        $plans = $this->repo->findByMdaId($mda_id);
        return view('procurementplan.adminallsubmissions')->with('plans', $plans);
    }

    public function edit($id)
    {
        $plan = $this->repo->findById($id);
        if(!isset($plan)) {
            return redirect()->with([
                'message' =>'Record not found',
                'alert-type' => 'error'
            ]);
        }

        if(isset($plan->plan_title) && $plan->plan_title == 'works'){
            return view('procurementplan.editworks')->with('plan', $plan);
        }

        if(isset($plan->plan_title) && $plan->plan_title == 'goods'){
            return view('procurementplan.editgoods')->with('plan', $plan);
        }

        if(isset($plan->plan_title) && $plan->plan_title == 'consultancy'){
            return view('procurementplan.editconsultancy')->with('plan', $plan);
        }

    }

    public function update(Request $request, $id)
    {
        try {
            $plan = $this->repo->update($request, $id);
            if ($plan == 1) {
                return redirect()->back()->with([
                    'message'=>'Record Updated Successfully',
                    'alert-type' => 'success'
                ]);
            } else {
                return redirect()->back()->withInout()->with([
                    'message' => 'Error updating record... Please try again.',
                    'alert-type' => 'error'
                ]);
            }
        } catch (QueryException $e) {
            return redirect()->back()->with([
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    public function approvePlan(Request $request) {
        try {
//            if($request->action_type == 'decline') {
//                $plan = $this->repo->approveDeclinePlan($request);
//            }else {
                $plan = $this->repo->approveDeclinePlan($request);
//            }

            if ($plan) {
                $notification = array(
                    'message' => 'Updated successfully',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            } else {
                $notificationErr = array(
                    'message' => 'Failed to update',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notificationErr)->withErrors('Error approving plan... Please try again.');
            }
        } catch (\QueryException $e) {
            return redirect()->back()->with([
                'message' => "An error occurred",
                'alert-type' => 'error'
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $plan = $this->repo->findById($id);
            $result =  $this->repo->destroy($id);
            if($result){
                return redirect()->route('procurementPlan.viewall', ['year' => $plan->year_id])->with([
                    'message'=>'Record Deleted Successfully',
                    'alert-type' => 'success'
                ]);
                // return redirect()->back()->with([
                //     'message'=>'Record Deleted Successfully',
                //     'alert-type' => 'success'
                // ]);
            }else{
                throw new \Exception('Unable to delete the record');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Unable to delete the record. Dependecy problem.',
                'alert-type' => 'error'
            ]);
        }
    }
}
