<?php

namespace App\Repositories\ContractorMachinery;

use App\ContractorMachinery;
use App\User;
use App\Repositories\ContractorMachinery\ContractorMachineryContract;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;


class EloquentContractorMachineryRepository implements ContractorMachineryContract{

    public function createMachinery($request) { 
        $machinery = new ContractorMachinery;

        if($request->acquisition_date > Carbon::now()->isoFormat('Y-m-d')) {
            return 'Invalid Acquisition Date';
        }
        else 
        if($request->cost < 0) {
            return  'Invalid Cost Amount';
        }
       

        $this->setContractorJobsProperties($machinery, $request);
        $machinery->save();
        return 1;
    }

    public function getMachineriesById() {
        return ContractorMachinery::where("user_id", Auth::user()->id)->get();
    }

    public function removeMachinery($request){ 
        $data = $request['mids'];
       try {
            for($i=0; $i<sizeof($data); $i++){
                 $tmp = ContractorMachinery::find($data[$i]);
                 $tmp->delete();
             }
           return true;
       }
       catch(\Exception $e){
           return false;
       }
    }

    private function setContractorJobsProperties($machine, $request) {
        $user = Auth::user();
        $machine->equipment_type = $request->equipment_type;
        $machine->specifics = $request->specifics;
        $machine->acquisition_date = $request->acquisition_date; 
        $machine->cost= $request->cost;
        $machine->location = $request->location;
        $machine->serial_no = $request->serial_no;
        $machine->equipment_status = $request->equipment_status;  
        $machine->user_id = $user->id;

    }

    public function find($id)
    {
       return ContractorMachinery::where('user_id', $id)->get();
    }

}

?>
