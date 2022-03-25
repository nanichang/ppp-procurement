<?php

namespace App\Repositories\ProcurementYear;

use App\Repositories\ProcurementYear\ProcurementYearContract;
use App\ProcurementYear;

class EloquentProcurementYearRepository implements ProcurementYearContract {
    public function create($request) {

        disableAllyears();
        $year = new ProcurementYear();
        $year->year = $request['year'];
        $year->active = true;
        $year->save();
        return 1;
    }

    public function getAll() {
        return ProcurementYear::paginate(10);
    }

    public function disableYear($id) {
        $year = ProcurementYear::find($id);
        $year->active = false;
        $year->save();
        return 1;
    }

    public function enableYear($id) {
        disableAllyears();
        $year = ProcurementYear::find($id);
        $year->active = true;
        $year->save();
        return 1;
    }

    public function deleteYear($request){ 
        try {
            $data = $request['mda'];
            for($i=0; $i<sizeof($data); $i++){
                $tmp = ProcurementYear::find($data[$i]);
                $tmp->delete();       
            }
            return true;

        }
        catch(\Exception $e){
            return false;
        } 
    }

}
