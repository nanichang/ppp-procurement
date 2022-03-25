<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Database\QueryException;
use App\Mda;
use App\Repositories\MDA\MdaContract;
use App\Repositories\PlanAdvert\PlanAdvertContract;
use App\Repositories\BusinessCategory\BusinessCategoryContract;
use App\Repositories\TenderEligibility\TenderEligibilityContract;
use App\Repositories\Sales\SalesContract;
use Auth;
use App\AdvertMode;
use App\AdvertType;
use App\ProcurementPlan;
use App\EvaluatorComment;
use App\AdvertLot;
use App\PlanAdvert;

class MDAController extends Controller{

    protected $repo;
    protected $advert_contract;
    protected $contract_category;
    protected $contract_requirement;
    protected $salesRepo;

    public function __construct(MdaContract $mdaContract, PlanAdvertContract $advertContract,
    BusinessCategoryContract $categoryContract, TenderEligibilityContract $eligibilityContract,
    SalesContract $salesContract){
        $this->middleware('auth');
        $this->repo = $mdaContract;
        $this->advert_contract = $advertContract;
        $this->contract_category = $categoryContract;
        $this->contract_requirement = $eligibilityContract;
        $this->salesRepo = $salesContract;

    }

    public function index(){
        try {
            $mdas = $this->repo->listMdas();
            $categories = $this->contract_category->allBusinessCategories();
            $banks = ['Access bank', 'Citibank', 'Ecobank', 'Fidelity Bank', 'First Bank', 'First City Monument Bank', 'Guaranty Trust Bank', 'Heritage Bank', 'Keystone Bank', 'Skye Bank', 'Stanbic IBTC Bank', 'Sterling Bank', 'Union Bank', 'United Bank for Africa', 'Wema bank', 'Zenith bank', 'Jaiz bank'];
            if ($mdas) {
                return view('admin/manageMDA', ['mdas' => $mdas, 'categories' => $categories, 'banks' => $banks]);
            }
            else {
                return response()->json(['responseText' => 'Error retriving MDAs'], 500);
            }

        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);

        }
    }

    public function getMdas() {
        try {
            $mdas = $this->repo->listMdas();
            $categories = $this->contract_category->allBusinessCategories();
            $banks = ['Access bank', 'Citibank', 'Ecobank', 'Fidelity Bank', 'First Bank', 'First City Monument Bank', 'Guaranty Trust Bank', 'Heritage Bank', 'Keystone Bank', 'Skye Bank', 'Stanbic IBTC Bank', 'Sterling Bank', 'Union Bank', 'United Bank for Africa', 'Wema bank', 'Zenith bank', 'Jaiz bank'];
            if ($mdas) {
                return view('admin/manageMDA', ['mdas' => $mdas, 'categories' => $categories, 'banks' => $banks]);
            }
            else {
                return response()->json(['responseText' => 'Error retriving MDAs'], 500);
            }

        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);

        }
    }

    public function createAdvert(Request $request){
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
        $adverts = $this->advert_contract->listAdvertsByUserId();
        $categories = $this->contract_category->allBusinessCategories();
        return view('mda/createAdvert', ['adverts' => $adverts, 'categories' => $categories, 'jsArray' => $jsArray,
        'vehicleMakes' => $vehicleMakes,
        'vehicleModels' => $vehicleModels]);
    }

    public function bidRequirements(Request $request, $advertId){
        $advert = $this->advert_contract->getAdvertById($advertId);
        $names = $this->contract_requirement->listAllEligibility();
        return view('mda/bidRequirements', ['advert' => $advert, 'names' => $names]);
    }


    public function storeMdas(Request $request){
        try {
            $data = $request->all();
            $mdas = $this->repo->create($data);

            if ($mdas == 1) {
                return response()->json(['success'=>'Record Added Succesfully.'], 200);
            }
            else {
                return response()->json(['error' => $mdas], 500);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function mdasPreview($id) {

        try {
            $mdas = $this->repo->find($id);
            if ($mdas) {
                return view('admin/manageMDA_preview', ['mdas' => $mdas]);
            }
            else {
                return response()->json(['responseText' => 'Error showing MDAs'], 500);
            }

        } catch (\Exception $e) {
         return response()->json(['response' => $e->getMessage()], 500);

        }

    }

    public function getMDAAdvertById($advertId) {
        $advert = $this->advert_contract->getById($advertId);

        return view('mda.AdvertPreview')->with(['advert' => $advert]);
    }

    public function viewAdvertById($advertId) {
        $advert = $this->advert_contract->getById($advertId);
        return view('admin.AdvertPreview')->with(['advert' => $advert]);
    }
    
    public function viewContractorAdvertById($advertId) {
        $advert = $this->advert_contract->getById($advertId);
        return view('contractor.AdvertPreview')->with(['advert' => $advert]);
    }

    public function viewAdvertOpeningById($advertId) {
        $advert = $this->advert_contract->getById($advertId);
        return view('admin.tools.AdvertPreview')->with(['advert' => $advert]);
    }

    public function viewSubmittedLots(Request $request) {
        $advertLots = AdvertLot::where('plan_advert_id', $request->advert_id)->get();
        $planAdvert = PlanAdvert::find($request->advert_id);

        if(isset($_GET['advert_lot_id']) && (int) $_GET['advert_lot_id'] > 0){
            $advert_lot_id = (int) $_GET['advert_lot_id'];
            $sales = $this->salesRepo->viewAllSubmiitedSales($request->advert_id, $advert_lot_id);
        }else{
            $advert_lot_id = 0;
            $sales = $this->salesRepo->viewAllSubmiitedSales($request->advert_id);
        }

        return view('mda.tools.submittedLots')->with(['sales' => $sales, 'advert_lot_id' => $advert_lot_id,
            'advertLots' => $advertLots, 'planAdvert' => $planAdvert]);
    }
    
    public function viewSingleSubmittedLot(Request $request) {
        // dd($request->all()); 
        $sale = $this->salesRepo->viewSingleSubmitedSaleByAdvertLotId($request->advert_lot_id);
        $evs = $sale->evaluatorLotEvaluations->groupBy('evaluator_id');
        $plan = ProcurementPlan::where('id', $sale->planAdvert->procurement_plan_id)->first();
        // dd($sale);
        $comments = EvaluatorComment::where('advert_lot_id', $sale->advert_lot_id)->get();

        if($request->isMethod('post')) {
            $sale = $this->salesRepo->awardContractToContractor($request);
            if($sale == 1) {
                $notification = array(
                    'message' => 'Contract has been awarded Successful!',
                    'alert-type' => 'success'
                );
    
                return redirect()->back()->with($notification);
            }
            else {
                $notification = array(
                    'message' => 'Failed to award contract',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }
        return view('mda.tools.singleSubmittedLot', compact('sale', 'plan', 'comments', 'evs'));
    }

    public function getPasswordUpdate() {
        return view('mda.PasswordUpdate');
    }

    public function listMdaBidOpeningAdverts(Request $request){
        $advert = $this->advert_contract->getById($advertId);
    }

    public function listMdaAdverts(Request $request){
        $advert = $this->advert_contract->getById($advertId);
    }


    public function deleteMda(Request $request){
        try {
            $mda = $this->repo->removeMda($request->all());
            if ($mda) {
                return response()->json(['success'=>' Mdas Deleted Successfully'], 200);
             } else {
                return response()->json(['error' => 'Failed to Delete'], 500);
             }
        } catch (\Exception $e) {
         return response()->json(['response' => $e->getMessage()], 500);
        }
    }
}
