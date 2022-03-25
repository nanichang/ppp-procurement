<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contractor\ContractorContract;
use App\Repositories\Director\DirectorContract;
use App\Repositories\OwnershipStructure\OwnershipStructureContract;
use App\Repositories\Countries\CountriesContract;
use App\Repositories\ContractorCategory\ContractorCategoryContract;
use App\Repositories\BusinessCategory\BusinessCategoryContract;
use App\Repositories\BusinessSubCategory1\BusinessSubCategoryContract;
use App\Repositories\BusinessSubCategory2\BusinessSubCategory2Contract;
use App\Repositories\ContractorPersonnel\ContractorPersonnelContract;
use App\Repositories\ContractorJobs\ContractorJobsContract;
use App\Repositories\ContractorFinance\ContractorFinanceContract;
use App\Repositories\Equipments\EquipmentContract;
use App\Repositories\CompanyOwnership\CompanyOwnershipContract;
use App\Repositories\Qualifications\QualificationContract;
use App\Repositories\ContractorMachinery\ContractorMachineryContract;
use App\Repositories\CategoryFee\CategoryFeeContract;
use App\Repositories\PdfCertificateName\PdfCertificateNameContract;
use App\Repositories\Compliance\ComplianceContract;
use App\Repositories\PlanAdvert\PlanAdvertContract;
use App\Repositories\Sales\SalesContract;
use App\Repositories\CompletedRegistration\CompletedRegistrationContract;
use Illuminate\Support\Facades\Storage;

use App\ContractorFile;
use App\User;
use PDF;
use App\BusinessCategory; 
use App\BusinessSubCategory1;
use App\ContractorRegistration;
use App\Contractor;

//use Illuminate\Events\Dispatcher;

class ContractorController extends Controller {
    protected $repo;
    protected $directorRepo;
    protected $contractorCategory;
    protected $ownerhip;
    protected $county;
    protected $business_cate;
    protected $business_cate1;
    protected $business_cate2;
    protected $contract_personnel;
    protected $contract_job;
    protected $contractFinance;
    protected $equipment;
    protected $ownership;
    protected $qualification;
    protected $machinery;
    protected $contract_fee;
    protected $contract_pdf;
    protected $contract_compliance;
    protected $contract_advert;
    protected $contract_sales;
    protected $contract_completedRegistration;


    public function __construct(ContractorContract $contractorContract, DirectorContract $directorContract,
                                ContractorCategoryContract $contractorCategoryContract, OwnershipStructureContract $ownershipStructure,
                                CountriesContract $country, BusinessCategoryContract $businessCategory, BusinessSubCategory2Contract $businessCategory2,
                                ContractorJobsContract $contractorJob, BusinessSubCategoryContract $businessCategory1, ContractorPersonnelContract $contractorPersonnel,
                                ContractorFinanceContract $contractorFinanceContract, EquipmentContract $equipmentsContract , CompanyOwnershipContract $companyOwnership ,
                                QualificationContract $qualificationContract, ContractorMachineryContract $contractorMachinery, CategoryFeeContract $categoryFeeContract,
                                PdfCertificateNameContract $pdfCertificateName, ComplianceContract $complianceContract, PlanAdvertContract $advertContract, SalesContract $salesContract,
                                CompletedRegistrationContract $completedContract ) {

        $this->middleware('auth');
        $this->repo = $contractorContract;
        $this->directorRepo = $directorContract;
        $this->contractorCategory = $contractorCategoryContract;
        $this->ownership = $ownershipStructure;
        $this->county = $country;
        $this->business_cate = $businessCategory;
        $this->business_cate1 = $businessCategory1;
        $this->contract_personnel = $contractorPersonnel;
        $this->contract_job = $contractorJob;
        $this->business_cate2 = $businessCategory2;
        $this->contractFinance = $contractorFinanceContract;
        $this->equipment = $equipmentsContract;
        $this->tcc_ownership = $companyOwnership;
        $this->qualification = $qualificationContract;
        $this->machinery = $contractorMachinery;
        $this->contract_fees = $categoryFeeContract;
        $this->contract_pdf = $pdfCertificateName;
        $this->contract_compliance = $complianceContract;
        $this->contract_advert = $advertContract;
        $this->contract_sales = $salesContract;
        $this->contract_completedRegistration = $completedContract;

    }

    public function registration(Request $request){
         $user = $this->repo->getUserById();
         $directors = $this->directorRepo->getCompanyDirectors();
         $categories = $this->contractorCategory->getCategoriesById();
         $owner_ship = $this->ownership->listOwnershipStructure();
         $countries = $this->county->allCountries();
         $b_categories = $this->business_cate->listAllBusinessCategories();
         $personnels = $this->contract_personnel->getPersonnelsById();
         $jobs =$this->contract_job->getJobsById();
         $b_categories2= $this->business_cate2->allBusinessSubCategory();
         $finances = $this->contractFinance->getFinancesById();
         $equipments = $this->equipment->listEquipments();
         $tcc_ownerships = $this->tcc_ownership->listCompanyOwnership();
         $qualifications = $this->qualification->listQualifications();
         $machineries = $this->machinery->getMachineriesById();
         $fees = $this->contract_fees->listAllFee();
         $company = $this->repo->getCompanyById();
         $compliance = $this->contract_compliance->getCompliancesById();

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

        $contractor = Contractor::where('user_id', $user->id)->first();
        $reg = ContractorRegistration::where('contractor_id', $contractor->id)->first();
        $enableCrud = true;
        if($reg && ($reg->status == 'pending' || $reg->status == 'verified' )){
            $enableCrud = false;
        }

        return view('contractor/registration', ['user' => $user, 'directors' => $directors,
        'contractorcategories' =>  $categories, 'ownerships' => $owner_ship,
        'countries' => $countries, 'allcategories' => $categories, 'contractorcategories' =>  $categories,
        'business_cates' => $b_categories, 'personnels' => $personnels,
        'jobs' => $jobs, 'business_cates2' => $b_categories2, 'finances' => $finances, 'equipments' => $equipments,
        'fees' => $fees, 'company' => $company, 'compliance' => $compliance,
        'tcc_ownerships' => $tcc_ownerships, 'qualifications' => $qualifications, 'machineries' => $machineries,
        'cac' => ContractorFile::where('name', 'cac')->where('user_id', $user->id)->first(),
        'tcc' => ContractorFile::where('name', 'tcc')->where('user_id', $user->id)->first(),
        'tin' => ContractorFile::where('name', 'tin')->where('user_id', $user->id)->first(),
        'pencom' => ContractorFile::where('name', 'pencom')->where('user_id', $user->id)->first(),
        'itf' => ContractorFile::where('name', 'itf')->where('user_id', $user->id)->first(),
        'audited_account' => ContractorFile::where('name', 'audited_account')->where('user_id', $user->id)->first(),
        'swon_affidavit' => ContractorFile::where('name', 'swon_affidavit')->where('user_id', $user->id)->first(),
        //'placcima' => ContractorFile::where('name', 'placcima')->where('user_id', $user->id)->first(),
        'jsArray' => $jsArray,
        'vehicleMakes' => $vehicleMakes,
        'vehicleModels' => $vehicleModels,
        'disableCrud' => !$enableCrud,
        ]);
    }

    public function storeContractor(Request $request) {

       try {
           $contractor = $this->repo->createContractor($request);

           if ($contractor) {
               return response()->json(['success'=>'Record Update Succesful.'], 200);
            } else {
                return response()->json(['error'=> 'Error Occured Contact Admin'], 500);
            }
       } catch (QueryException $e) {
        return response()->json(['error' => $e->getMessage()], 500);
       }
    }

    public function reportsContractor() {
       // echo("contracts reports data table");
        return view('contractor.reports');
    }

    public function getDocumentsByUserId(){
        return ContractorFile::where('user_id',  Auth::user()->id)->get();
    }

    public function uploadContractorFile(Request $request){
        //Upload file return file name. associate file on storage with user_id
        $url = null;
        $oldKey = null;
        $user = Auth::user();
        $name = $request->input('name');
        $cf = ContractorFile::where('user_id', $user->id)->where('name', $name)->first();
        if(!$cf){
            $cf = new ContractorFile;
            $cf->user_id = $user->id;
        }

        $file = $request->file('file');
        if(!$file){
            return response()->json(['status' => 'failure'], 400);
        }
        $filenamewithoutext = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $filename = $filenamewithoutext.'_'.time().'.'.$extension;
        $mimeType = $file->getMimeType();
        $fileSize = $file->getSize();
        $directory = 'uploads/C-' .$user->id . "-" .$filename;
        $displayName = 'C-'.$user->id . "-" .$filename;

        $cf->mime_type = $mimeType;
        $cf->size = $fileSize;
        $cf->name = $name;
        $cf->key = $displayName;
        $oldKey = $cf->key;
        $uploaded = Storage::disk('s3')->put($directory, file_get_contents($file), 'public');

        if($uploaded){
             $saved = $cf->save();
            return response()->json($cf, 200);
        }
        return response()->json(['status' => 'failure'], 400);
    }

    public function deleteContractorFile(Request $request){
        $user = Auth::user();
        $cf = ContractorFile::where('name', $request->input('name'))->where('user_id', $user->id)->first();
        $cf->delete();
        return response()->json(['status' => 'success'], 200);
    }

    public function getContractorFile() {
        $user = Auth::user();
        $getUploadfiles = ContractorFile::where('name', $request->input('name'))->where('user_id', $user->id)->first();
        return view('admin/contractors_preview', ['getUploadfiles' => $getUploadfiles]);
    }

    public function editContractorStatus($id,  $value) {
        $response = $this->repo->updateAccountStatus($id, $value);
        if($response == 1){
            $notification = array(
                'message' => 'Success, Account Updated!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'Failed to Activate Account!',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function downloadPDF($registrationId){
        $user = User::where('id', Auth::user()->id)->first();
        $category = $this->contract_completedRegistration->getRegistrationsById($registrationId);
        $pdf = PDF::loadView('contractor/pdf', compact('user'), ['data' => $category]);
        return $pdf->download('irr.pdf');
      }

    public function getIRR(){
        $categories = $this->contract_completedRegistration->getRegistrationsByUserId();
        $user = Auth::user();
        $contractor = Contractor::where('user_id', $user->id)->first();
        $registration = ContractorRegistration::where('contractor_id', $contractor->id)->first();
        return view('contractor.partials.IrrDocs', ['categories' => $categories, 'registration' => $registration]);
    }

    public function getAdvertById($advertId) {
        $advert = $this->contract_advert->getPublishedAdvertById($advertId);
        $transactions = $this->contract_sales->listSalesByUserandAdvertId($advertId);
        // dd($transactions);
        $user = Auth::user();
        return view('contractor.SelectBid', compact('advert', 'user', 'transactions'));
    }

    public function getUploadedDocuments(){
        $getUploadfiles = ContractorFile::where('user_id', Auth::user()->id)->get();
        return view('contractor.BiddingDocuments')->with(['documents' => $getUploadfiles]);
    }

    public function getTransactions() {
        $transactions = $this->contract_sales->listSalesByUserId();
        return view('contractor.Transactions')->with(['transactions' => $transactions]);
    }

    public function getPasswordUpdate() {
        return view('contractor.PasswordUpdate');
    }

    public function updatePassword(Request $request) {
        $update = $this->repo->editPassword((object)$request->all());
        if ($update == 1) {
            $notification = array(
                'message' => 'Password Update Successful!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
         }
         else {
            $notification = array(
                'message' => $update,
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification)->withInput();
        }

    }

    public function completeRegistration(Request $request) {
       // dd($request);
        $completed = $this->contract_completedRegistration->create($request);

        if($completed == 1) {
            $notification = array(
                'message' => 'Registration was Successful!',
                'alert-type' => 'success'
            );

            return redirect()->route('getIRR')->with( $notification);
        }
        else {
            $notification = array(
                'message' => $completed,
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }

    }

}
