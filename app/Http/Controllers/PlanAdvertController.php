<?php

namespace App\Http\Controllers;

use App\MdaPlan;
use App\PlanAdvertDocument;
use App\ProcurementYear;
use App\Repositories\ProcurementPlan\ProcurementPlanContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Repositories\PlanAdvert\PlanAdvertContract;
use App\Repositories\BusinessCategory\BusinessCategoryContract;
use App\AdvertCriteria;
use App\AdvertMode;
use App\AdvertType;
use Carbon\Carbon;
use App\ContractorRegistration;
use App\Contractor;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contractor\ContractorContract;
use App\Mda;
use App\Sales;
use App\ContractorAdvertCriteria;


class PlanAdvertController extends Controller
{
    protected $repo;
    protected $procurementPlanRepo;
    protected $contract_category;
    protected $contractorModel;

    public function __construct(
        PlanAdvertContract $planAdvertContract,
        ProcurementPlanContract $procurementPlanContract,
        BusinessCategoryContract $categoryContract,
        ContractorContract $contractorModel
    ) {
        $this->middleware('auth');
        $this->repo = $planAdvertContract;
        $this->procurementPlanRepo = $procurementPlanContract;
        $this->contract_category = $categoryContract;
        $this->contractorModel = $contractorModel;
    }

    public function create($plan_id)
    {
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
        $categories = $this->contract_category->allBusinessCategories();
        $project = $this->procurementPlanRepo->findById($plan_id);
        $year = ProcurementYear::where('active', true)->first();
        return view('planadvert.create', ['project' => $project, 'year' => $year, 'categories' => $categories, 'jsArray' => $jsArray,
        'vehicleMakes' => $vehicleMakes,
        'vehicleModels' => $vehicleModels]);
    }

    public function addCriteria(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'title'    => 'required',
            ]);

            if($validator->fails()) {
                return redirect()->back()->with([
                    'message'=>'Title is required',
                    'alert-type' => 'error'
                ]);
            }

            $ac = new AdvertCriteria;
            $ac->title = $request->title;
            $ac->description = $request->description;
            $ac->required = $request->required ? true : false;
            $ac->plan_advert_id = $request->advert_id;
            $ac->save();

            return redirect()->back()->with([
                'message'=>'Advert criteria created successfully',
                'alert-type' => 'success'
            ]);

        } catch (QueryException $e) {
            return redirect()->back()->with([
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'closing_date'    => 'required|date|after:bid_opening_date',
            //     'introduction' => 'required',
            //     'bid_opening_date'      => 'required|date',
            //     'advert_type' => 'exists:advert_types,id',
            //     'advert_mode' => 'exists:advert_modes,id'
            // ]);

            // if($validator->fails()) {
            //     return redirect()->back()->with([
            //         'message'=>'Closing date must be a future date and advert type and mode are compulsory',
            //         'alert-type' => 'error'
            //     ]);
            // }

            $advert = $this->repo->create($request);
            if ($advert > 0) {
                return redirect()->route('create-plan-advert.preview', $advert)->with([
                    'message'=>'Advert created successfully',
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

    public function updateAdvert(Request $request) {
        try {

            if ($this->repo->editMDAAdvert((object)$request->all())) {
                $notification = array(
                    'message' => 'Successfully Updated Advert!',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
             }
             else {
                $notification = array(
                    'message' => 'Error Occured During update!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
             }
         } catch (QueryException $e) {
            $notification = array(
                'message' => 'Error Occured During update!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
         //return response()->json(['response' => $e->getMessage()], 500);
        }
     }

    public function show($id)
    {
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
        $categories = $this->contract_category->allBusinessCategories();
        $advert = $this->repo->getById($id);
        if (!$advert) {
            return redirect()->back()->with([
                'message' => 'Record not found',
                'alert-type' => 'error'
            ]);
        }

        $docs = PlanAdvertDocument::where('advert_id', $advert->id)->get();
        if(!isset($advert)) {
            return redirect()->back()->with([
                'message'=>'No advert found.',
                'alert-type' => 'error'
            ]);
        }

        $sales = Sales::with(['contractor', 'planAdvert'])->where('advert_id', $advert->id)->where('payment_status', 'Paid')->get()->groupBy('contractor_id');

        // dd($sales);

        return view('planadvert.show', ['advert' => $advert, 'docs' => $docs, 'categories' => $categories, 'jsArray' => $jsArray,
        'vehicleMakes' => $vehicleMakes,
        'vehicleModels' => $vehicleModels,
        'contractors' => $sales]);
    }

    public function submitContractorCriterea(Request $request)
    {
        try {
            $user = Auth::user();
            $data = $request->acids ? $request->acids : [];
            // dd($data);
            ContractorAdvertCriteria::where('plan_advert_id', $request->advert_id)
                ->where('contractor_id', $request->contractor_id)->delete();
            Sales::where('contractor_id', $request->contractor_id)->where('advert_id', $request->advert_id)->update(['passed_evaluation' => false]);
            $advertCriterias = AdvertCriteria::where('plan_advert_id', $request->advert_id)->get();
            $passed = true;
            for($i = 0; $i < sizeof($advertCriterias); $i++){
                $found = false;
                for($j = 0; $j < sizeof($data); $j++ ){
                    if($advertCriterias[$i]->id == $data[$j]){
                        $found = true;
                        break;
                    }
                }
                if($found && $advertCriterias[$i]->required){
                    $cac = new ContractorAdvertCriteria;
                    $cac->plan_advert_id = $request->advert_id;
                    $cac->contractor_id = $request->contractor_id;
                    $cac->advert_criteria_id = $advertCriterias[$i]->id;
                    $cac->passed = true;
                    $cac->approved_by = $user->name;
                    $cac->save();
                }else if($found && !$advertCriterias[$i]->required){
                    $cac = new ContractorAdvertCriteria;
                    $cac->plan_advert_id = $request->advert_id;
                    $cac->contractor_id = $request->contractor_id;
                    $cac->advert_criteria_id = $advertCriterias[$i]->id;
                    $cac->passed = true;
                    $cac->approved_by = $user->name;
                    $cac->save();
                }else if(!$found && !$advertCriterias[$i]->required){
                    $cac = new ContractorAdvertCriteria;
                    $cac->plan_advert_id = $request->advert_id;
                    $cac->contractor_id = $request->contractor_id;
                    $cac->advert_criteria_id = $advertCriterias[$i]->id;
                    $cac->passed = true;
                    $cac->approved_by = $user->name;
                    $cac->save();
                }else{
                    $cac = new ContractorAdvertCriteria;
                    $cac->plan_advert_id = $request->advert_id;
                    $cac->contractor_id = $request->contractor_id;
                    $cac->advert_criteria_id = $advertCriterias[$i]->id;
                    $cac->passed = false;
                    $cac->approved_by = $user->name;
                    $cac->save();
                    $passed = false;
                }
            }
            Sales::where('contractor_id', $request->contractor_id)->where('advert_id', $request->advert_id)->update(['passed_evaluation' => $passed]);

            return redirect()->back()->with([
                'message'=>'Update successfully',
                'alert-type' => 'success'
            ]);


        } catch (Exception $e) {
            return redirect()->back()->with([
                    'message'=>'Error processing update... Please try again.',
                    'alert-type' => 'error'
            ]);
        }
        
    }

    public function toggleAdvert($advertId, $status) {
        $toggle = $this->repo->updateAdvertStatus($advertId, $status);
        $adverts = $this->repo->listAllAdverts();
        $notification = array(
            'message' => 'Successfully Toggled Advert State!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function approveAdvert(Request $request, $id)
    {
        try {
            $doc = $this->repo->approveAdvertDocuments($request, $id);
            if ($doc == 1) {
                return redirect()->back()->with([
                    'message'=>'Approved successfully',
                    'alert-type' => 'success'
                ]);
            } else {
                return redirect()->back()->with([
                    'message'=>'Error processing approval... Please try again.',
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

    public function disapproveAdvert(Request $request, $id)
    {
        try {

            $doc = $this->repo->disapproveAdvert($request, $id);
            if ($doc == 1) {
                return redirect()->back()->with([
                    'message'=>'Action was successfully',
                    'alert-type' => 'success'
                ]);
            } else {
                return redirect()->back()->with([
                    'message'=>'Error processing disapproval... Please try again.',
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

    public function deleteCriteria(Request $request){

        try {
            $data = $request->acids;
            for($i = 0; $i < sizeof($data); $i++ ){
                $client = AdvertCriteria::where('id', $data[$i])->delete();
            }

            return redirect()->back()->with([
                'message'=>'Deleted successfully',
                'alert-type' => 'success'
            ]);


        } catch (Exception $e) {
            return redirect()->back()->with([
                    'message'=>'Error processing deletion... Please try again.',
                    'alert-type' => 'error'
            ]);
        }

    }

    public function deleteAdvertDocument(Request $request){
        try {
            $data = $request->ids;
            for($i = 0; $i < sizeof($data); $i++ ){
                $client = PlanAdvertDocument::where('id', $data[$i])->delete();
            }

            return redirect()->back()->with([
                'message'=>'Deleted successfully',
                'alert-type' => 'success'
            ]);


        } catch (Exception $e) {
            return redirect()->back()->with([
                    'message'=>'Error processing deletion... Please try again.',
                    'alert-type' => 'error'
                ]);
        }
    }

    public function Adverts(Request $request, $planId){
        $adverts = $this->repo->listAdvertsByPlanId($planId);
        $categories = $this->contract_category->listAllBusinessCategories();
      //  $lots = $this->repo->listAdvertLotsByAdverts();
        return response()->json(['adverts' => $adverts, 'categories' => $categories], 200);
    }

    public function deleteAdvert(Request $request) {
        try {
            $advert = $this->repo->removeAdvert($request);
            if ($advert) {
                return response()->json(['success' => 'records deleted successfully'], 200);
                //return view('mda.createAdvert', ['adverts' => $adverts]);
            } else {
                return response()->json(['response' => 'failed to delete records. Delete the dependencies first.'], 500);
             }
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
        }
    }

    public function getPublishedAdverts() {
        $adverts = $this->repo->listAllPublishedAdverts();
        $user = Auth::user();
        $contractor = Contractor::where('user_id', $user->id)->first();
        $registration = ContractorRegistration::where('contractor_id', $contractor->id)->first();
        return view('contractor.AdvertList', compact('adverts', 'registration'));
    }

    public function getPublishedAdvertsByCategory(Request $request, $Id){
        $adverts = $this->repo->listAllPublishedAdvertsByCategory($Id);
        $user = Auth::user();
        $contractor = Contractor::where('user_id', $user->id)->first();
        $registration = ContractorRegistration::where('contractor_id', $contractor->id)->first();
        return view('contractor.AdvertList', compact('adverts', 'registration'));
    }

    public function getMDAAdverts() {
        $user = Auth::user();
        $mda = Mda::where('email', $user->email)->first();
        $adverts = $this->repo->getMDAAdverts($mda->id);
        return view('mda.AdvertList', compact('adverts'));
    }

    public function getMDAOpeningAdverts() {
        $user = Auth::user();
        $mda = Mda::where('email', $user->email)->first();
        $adverts = $this->repo->getMDAOpeningAdverts($mda->id);
        return view('mda.AdvertOpenList', compact('adverts'));
    }

    public function getAllOpeningAdverts() {
        $adverts = $this->repo->getAllOpeningAdverts();
        return view('mda.AdvertOpenList', compact('adverts'));
    }

    public function getMDAAdvertsByCategory(Request $request, $Id){
        $user = Auth::user();
        $mda = Mda::where('email', $user->email)->first();
        $adverts = $this->repo->getMDAAdvertsByCategory($mda->id, $Id);
        return view('mda.AdvertList', compact('adverts'));
    }

    public function getAllAdverts(Request $request) {
        //admin access only
        $adverts = $this->repo->listAllAdverts();
        return view('mda.AdvertList', compact('adverts'));
    }

    public function getAllAdvertsByCategory(Request $request, $Id){
        //admin access only
        $adverts = $this->repo->getAllByCategory($Id);
        return view('mda.AdvertList', compact('adverts'));
    }

    public function getPublishedAdvertById(Request $request, $advertId){
        //TODO validate registration before allowing access
        $advert = $this->repo->getPublishedAdvertById($advertId);
        $contractor = $this->contractorModel->getContractorProfile();
        $message = null;

        if($contractor->isActive == 0) {
            $message = 'Contact Admin for Documents Verification and Activation';
            $notification = array(
                'message' => $message,
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        return view('contractor.AdvertPreview')
            ->with(['advert' => $advert]);
    }

    public function getAdverts(){
        $adverts = $this->repo->listAllAdverts();
        return view('admin.AdvertList')->with(['adverts' => $adverts]);
    }

    public function awardContract(Request $request) {
        try {
            $awarded = $this->repo->awardContractToContractor($request);
            if ($awarded) {
                return redirect()->back()->with([
                    'message'=>'Contract was awarded successfully',
                    'alert-type' => 'success'
                ]);
            } else {
                return redirect()->back()->with([
                    'message'=>'Error awarding contract... Please try again.',
                    'alert-type' => 'error'
                ]);
            }
        } catch (Exception $e) {
            return redirect()->back()->with([
                'message'=>'Error awarding contract... Please try again.',
                'alert-type' => 'error'
            ]);
        }   
    }
}
