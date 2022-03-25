<?php

namespace App\Repositories\Evaluator;

use App\Evaluator;
use App\Notifications\SendEvaluatorNotificationEmail;
use App\Repositories\Evaluator\EvaluatorContract;
use App\Mda;

class EloquentEvaluatorRepository implements EvaluatorContract {
    public function create($request)
    {
        
        $mda = Mda::where('email', $request->mda)->first();
        $ev = new Evaluator();
        $ev->name = $request->name;
        $ev->email = $request->email;
        $ev->user_type = $request->user_type;
        $ev->code = 'EV-'. rand(00000000, 99999999);
        $ev->mda_id = $mda->id;
        $ev->advert_lot_id = $request->advert_lot_id;
        $ev->plan_advert_id = $request->plan_advert_id;
        $ev->save();

        if($ev->id) {
            $mdaData = getMdaName($ev->mda_id);
            try{
                $ev->notify(new SendEvaluatorNotificationEmail($ev, $mdaData));
            }catch(\Exception $e){
                // die slowly
            }
        }
        return 1;
    }

    public function getAll()
    {
        return Evaluator::all();
    }
    
    public function getAllByMDA($id)
    {
        return Evaluator::where('mda_id', $id)->get();
    }
    
    public function getAllByLot($id)
    {
        return Evaluator::where('advert_lot_id', $id)->get();
    }

    public function findById($id)
    {
        return Evaluator::find($id);
    }

    public function findByCode($code)
    {
        return Evaluator::where('code', $code)->orderBy('created_at', 'DESC')->first();
    }

    public function findByEmailCodeAndId($request)
    {
        return Evaluator::where('code', $request->code)->where('email', $request->email)
        ->where('id', $request->id)
        ->orderBy('created_at', 'DESC')->first();
    }

    public function resendInvitation($code)
    {
        $ev = $this->findByCode($code);
        if($ev->id) {
            $mdaData = getMdaName($ev->mda_id);
            try{
                $ev->notify(new SendEvaluatorNotificationEmail($ev, $mdaData));
            }catch(\Exception $e){
                // die slowly..
            }
        }
        return 1;
    }

    public function destroy($id)
    {
        $ev = $this->findById($id);
        $ev->delete();
        return 1;
    }
}
