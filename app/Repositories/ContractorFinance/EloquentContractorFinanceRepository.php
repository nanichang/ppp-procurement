<?php
namespace App\Repositories\ContractorFinance;

use App\ContractorFinance;
use App\User;
use App\Repositories\ContractorFinance\ContractorFinanceContract;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;


class EloquentContractorFinanceRepository implements ContractorFinanceContract{

    public function createFinance($request) { 
        $contractorFinance = new ContractorFinance;

        if($request->year > Carbon::now()->format('Y')) {
            return 'Invalid Year';
        }
        else 
        if($request->turn_over < 0) {

            return  'Invalid Turn Over';
        }
       
        else if($request->total_asset < 0) {
            return 'Invalid Total Asset';
        }

        else if($request->total_liability < 0) {
            return 'Invalid Liability Amount';
        }
        else if($request->witholding_tax < 0) {

            return  'Invalid Withholding Tax';
        }
       
        else if($request->tax_paid< 0) {
            return 'Invalid paid Tax';
        }

        else if($request->report_date > Carbon::now()->format('Y-m-d') ) {
            return 'Invalid Report Date';
        }
        $this->setContractorFinanceProperties($contractorFinance, $request);
        $contractorFinance->save();
        return 1;
    }

    public function getFinancesById() {
        return ContractorFinance::where("user_id", Auth::user()->id)->get();
    }

    public function removeFinance($request) {
        $data = $request['fids'];
        try {
            for($i=0; $i<sizeof($data); $i++){
                $tmp = ContractorFinance::find($data[$i]);
                $tmp->delete();
           }
           return true;
        }
        catch(\Exception $e){
            return false;
        }
    }

    private function setContractorFinanceProperties($finance, $request) {
        $user = Auth::user();
        $finance->turn_over = $request->turn_over;
        $finance->total_asset = $request->total_asset;
        $finance->total_liability = $request->total_liability; 
        $finance->witholding_tax= $request->witholding_tax;
        $finance->tax_paid = $request->tax_paid;
        $finance->tcc_no = $request->tcc_no;
        $finance->audit_firm = $request->audit_firm;
        $finance->report_date = $request->report_date;
        $finance->year = $request->year;  
        $finance->user_id = $user->id;

    }

    public function find($id)
    {
       return ContractorFinance::where('user_id', $id)->get();
    }

}

?>
