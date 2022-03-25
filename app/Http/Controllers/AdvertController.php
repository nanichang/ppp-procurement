<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\QueryException;
use App\Repositories\PlanAdvert\PlanAdvertContract;
use App\Repositories\BusinessCategory\BusinessCategoryContract;
use App\Repositories\Director\DirectorContract;
use App\Repositories\ContractorCategory\ContractorCategoryContract;
use App\Repositories\ContractorPersonnel\ContractorPersonnelContract;
use App\Repositories\ContractorJobs\ContractorJobsContract;
use App\Repositories\ContractorFinance\ContractorFinanceContract;
use App\Repositories\ContractorMachinery\ContractorMachineryContract;
use App\Repositories\Contractor\ContractorContract;
use App\ContractorFile;
use Illuminate\Support\Facades\Auth;

class AdvertController extends Controller{

    protected $repo;
    protected $contract_category;

    protected $directorRepo;
    protected $contractorCategory;
    protected $contract_personnel;
    protected $contract_job;
    protected $contractFinance;
    protected $machinery;
    protected $contractorModel;


    public function __construct(PlanAdvertContract $advertContract, BusinessCategoryContract $categoryContract,
                            DirectorContract $directorContract, ContractorCategoryContract $contractorCategoryContract,
                            ContractorJobsContract $contractorJob, ContractorPersonnelContract $contractorPersonnel,
                            ContractorFinanceContract $contractorFinanceContract, ContractorMachineryContract $contractorMachinery,
                            ContractorContract $contractorModel){
            $this->middleware('auth');
            $this->repo = $advertContract;
            $this->contract_category = $categoryContract;
            $this->directorRepo = $directorContract;
            $this->contractorModel = $contractorModel;
            $this->contract_personnel = $contractorPersonnel;
            $this->contract_job = $contractorJob;
            $this->contractFinance = $contractorFinanceContract;
            $this->machinery = $contractorMachinery;
            $this->contractorCategory = $contractorCategoryContract;
    }

    public function Adverts(){
        $adverts = $this->repo->listAdvertsByUserId();
        $categories = $this->contract_category->listAllBusinessCategories();
      //  $lots = $this->repo->listAdvertLotsByAdverts();
        return response()->json(['adverts' => $adverts, 'categories' => $categories], 200);
    }

    private function registrationStatus(){

        $count = 0;
        $status = array();

        $personnels = $this->contract_personnel->getPersonnelsById();
        $jobs = $this->contract_job->getJobsById();
        $finances = $this->contractFinance->getFinancesById();
        $machines = $this->machinery->getMachineriesById();
        $directors = $this->directorRepo->getCompanyDirectors();
        $categories = $this->contractorCategory->getCategoriesById();
        $uploads = ContractorFile::where('user_id',  Auth::user()->id)->get();

        if(sizeof($personnels) > 0) {
            $count++;
            $status['personnels'] = true;
        }

        if(sizeof($jobs) > 0) {
            $count++;
            $status['jobs'] = true;
        }

        if(sizeof($finances) > 0) {
            $count++;
            $status['finances'] = true;
        }

        if(sizeof($directors) > 0) {
            $count++;
            $status['directors'] = true;
        }

        if(sizeof($categories) > 0) {
            $count++;
            $status['categories'] = true;
        }
        if(sizeof($machines) > 0) {
            $count++;
            $status['machines'] = true;
        }

        if(sizeof($uploads) > 6) {
            $count++;
            $status['uploads'] = true;
        }

        $status['percentage'] = round(($count/7)*100, 2);
         return $status;
    }


    public function storeAdvert(Request $request) {
       try {
            $result = $this->repo->createAdvert((object)$request->all());
           if ($result == 1) {
                $notification = array(
                    'message' => 'Advert Created Successfully!',
                    'alert-type' => 'success'
                );
                return response()->json(['success' => 'Record Added Successfully'], 200);
            }
            else {

                return response()->json(['error' => $result], 500);

            }
        } catch (QueryException $e) {
        return response()->json(['error' => $e->getMessage()], 500);
       }
    }

    public function updateAdvert(Request $request) {
        try {

            if ($this->repo->editAdvert((object)$request->all())) {
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


    public function deleteAdvert(Request $request) {
        try {
            $advert = $this->repo->removeAdvert($request);
            // $adverts = $this->repo->listAdvertsByUserId();
            if ($advert) {
                return response()->json(['success' => 'records deleted successfully'], 200);
                //return view('mda.createAdvert', ['adverts' => $adverts]);
            } else {
                return response()->json(['success' => 'failed to delete records'], 500);
             }
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
        }
     }

     public function getAdvertById($advertId) {
        $advert = $this->repo->getById($advertId);
        $registrationStatus = $this->registrationStatus();
        $contractor = $this->contractorModel->getContractorProfile();
        $message = null;


        if($registrationStatus['percentage'] !== 100.0 && false) {

            $message = 'Complete Your Profile Registration to Apply';
            $notification = array(
                'message' => $message,
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        else if($contractor->isActive == 0) {
            $message = 'Contact Admin for Documents Verification and Activation';
            $notification = array(
                'message' => $message,
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        return view('contractor.AdvertPreview')->with(['advert' => $advert, 'registrationStatus' => $registrationStatus]);
    }


    public function getAdverts(){
        $adverts = $this->repo->listAllAdverts();
        return view('admin.AdvertList')->with(['adverts' => $adverts]);
    }


    public function getAdvertsOpening(){
        $adverts = $this->repo->listApprovedAdverts();
        return view('admin.BidOpening')->with(['adverts' => $adverts]);
    }

    public function toggleAdvert($advertId, $status) {
        $toggle = $this->repo->updateAdvertStatus($advertId, $status);
        $adverts = $this->repo->listAllAdverts();
        $notification = array(
            'message' => 'Successfully Toggled Advert State!',
            'alert-type' => 'success'
        );
        return redirect()->route('adminAdverts')->with(['adverts' => $adverts])->with($notification);

    }

    public function getAdvertByCatId($catId){

        $adverts = $this->repo->getAdsByCatId($catId);
        return view('contractor.DisplayCategoryAdvert')->with(['adverts' => $adverts]);
    }

}
