<?php

    use App\Mda;
    use Carbon\Carbon;
    use App\ProcurementYear;
    use App\ProcurementPlan;

    function getMdaName($id) {
        return Mda::where('id', $id)->first();
    }

    function getUserRole() {
        return \Auth::user()->user_type;
    }

    function checkIfyearExist($request) {
        return ProcurementYear::where('year', $request['year'])->first();
    }

    function checkActiveYear($request) {
        $data = $request['mda'];
        for($i=0; $i<sizeof($data); $i++){
            $tmp = ProcurementYear::find($data[$i]);
            if($tmp->active == 1) {
                return 1;
            }
        }
    }

    function disableAllyears(){
        $years = ProcurementYear::all();
        foreach($years as $year) {
            $year->active = false;
            $year->save();
        }
    }

    function getPlanDetails($id) {
        $plan = ProcurementPlan::where('id', $id)->first();
        return $plan;
    }


