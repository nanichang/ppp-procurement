<?php

namespace App\Repositories\Compliance;

use App\Compliance;
use App\Repositories\Compliance\ComplianceContract;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Session;

class EloquentComplianceRepository implements ComplianceContract{

    public function createCompliance($request) {
        $compliance = new Compliance;
        //$datetime = new DateTime();
        $search = Compliance::where('user_id', Auth::user()->id)->get()->first();
        if($request->cac_date_of_reg && strlen($request->cac_date_of_reg) > 0 && Carbon::parse($request->cac_date_of_reg)->format('Y-m-d') > Carbon::now()->format('Y-m-d')) {
            return 'Invalid CAC Registration Date';
        }
        else
        if($request->tcc_tin_no != 'N/A' && strlen($request->tcc_tin_no) != 10 ) {
            return  'Invalid Tin Number';
        }

        else
        if($request->pension_certificate_number != 'N/A' && strlen($request->pension_certificate_number) < 2 ) {
            return  'Invalid Pension Certicate Number';
        }

        else
        if($request->itf_registration_no != 'N/A' && strlen($request->itf_registration_no) < 2 ) {
            return  'Invalid ITF Registration Number';
        }

        else
        if($request->itf_certificate_no != 'N/A' && strlen($request->itf_certificate_no) < 2 ) {
            return  'Invalid ITF Certificate Number';
        }

        else if($request->pension_expiring_date && strlen($request->pension_expiring_date) && Carbon::parse($request->pension_expiring_date)->format('Y-m-d') < Carbon::now()->format('Y-m-d')) {
            return 'Expired Pencom Cert. Not Allowed ';
        }

        else if($request->pension_no_of_employee != 'N/A' && $request->pension_no_of_employee < 1) {
            return 'Invalid No of  Employees';
        }
        else if($request->itf_payment_date && strlen($request->itf_payment_date) > 0 && Carbon::parse($request->itf_payment_date)->format('Y-m-d') > Carbon::now()->format('Y-m-d')) {
            return 'Invalid ITF Registration Date';
        }

        if($request->pension_no_of_employee == 'N/A'){
            $request->pension_no_of_employee = -1;
        }

        if($search) {
            $this->setComplianceProperties($search, $request);
             $search->save();
            return 1;
        }
        else {
            $this->setComplianceProperties($compliance, $request);
            $compliance->save();
            return 1;

        }
        return 0;
    }

    public function getCompliancesById(){
        return Compliance::where("user_id", Auth::user()->id)->first();

    }


    private function setComplianceProperties($compliance, $request) {
       // dd($request);
        $user = Auth::user();
        $compliance->company_name = $user->name;
        $compliance->parent_company = $request->parent_company;
        $compliance->cac_date_of_reg = ($request->cac_date_of_reg && strlen($request->cac_date_of_reg) > 0) ? Carbon::parse($request->cac_date_of_reg)->format('Y-m-d') : 'N/A';
        $compliance->cac_number =  $user->cac;
        $compliance->tcc_no = $request->tcc_no;
        $compliance->tcc_tin_no = $request->tcc_tin_no;
        $compliance->tcc_ownership_structure = $request->tcc_ownership_structure;
        $compliance->tcc_company_ownership = $request->tcc_company_ownership;
        $compliance->pension_employer_code= $request->pension_employer_code;
        $compliance->pension_certificate_number = $request->pension_certificate_number;
        $compliance->pension_expiring_date = ($request->pension_expiring_date && strlen($request->pension_expiring_date) > 0) ? Carbon::parse($request->pension_expiring_date)->format('Y-m-d') : 'N/A';
        $compliance->pension_no_of_employee = $request->pension_no_of_employee;
        $compliance->itf_registration_no=  $request->itf_registration_no;
        $compliance->itf_certificate_no =  $request->itf_certificate_no;
        $compliance->itf_payment_date = ($request->itf_payment_date && strlen($request->itf_payment_date) > 0) ? Carbon::parse($compliance->itf_payment_date)->format('Y-m-d') : 'N/A';
        $compliance->user_id = $user->id;


    }

    public function listAllCompliance()
    {
        return Compliance::all();
    }


}


?>
