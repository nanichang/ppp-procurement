<?php

namespace App\Http\Controllers;

use App\Contractor;
use App\ContractorRegistration;
use App\RegistrationPayment;
use Illuminate\Http\Request;
use App\Repositories\RegistrationPayment\RegistrationPaymentContract;
use DB;
class RegistrationPaymentController extends Controller
{
    protected $repo;

    public function __construct(RegistrationPaymentContract $registrationPaymentContract) {
        $this->repo = $registrationPaymentContract;
        $this->middleware('auth');
    }

    public function contractors()
    {
        $payments = $this->repo->findAll();
        return view('registrationpayment.index', compact('payments'));
    }

    public function create()
    {
        $user = auth()->user();
        $contractor = Contractor::where('user_id', $user->id)->first();
        $cr = ContractorRegistration::where('contractor_id', $contractor->id)->first();
        return view('registrationpayment.create', compact('contractor', 'cr'));
    }

    public function store(Request $request)
    {
        $payment = $this->repo->create($request);
        if($payment == 1) {
            return redirect()->back()->with([
                'message'=>'Submitted successfuly.',
                'alert-type' => 'success'
            ]);
        }else{
            
            return redirect()->back()->with([
                'message'=>'failed to submit.',
                'alert-type' => 'error'
            ]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function approve(Request $request)
    {
        try {
            DB::beginTransaction();
            // $contractor = Contractor::where('id', $request->contractor_id)->first();
            // if(!$contractor->isActive){
                // $contractor->isActive = true;
                // $contractor->save();

                $cr = ContractorRegistration::where('contractor_id', $request->contractor_id)->first();
                $cr->status = 'verified';
                $cr->approved_by = auth()->user()->name;
                $cr->paid = true;
                $cr->save();

                $rp = RegistrationPayment::find($request->id);
                $rp->payment_type = $request->payment_type;
                $rp->status = 'verified';
                $rp->contractor_id = $request->contractor_id;
                $rp->amount = $request->amount;
                $rp->approved_by = auth()->user()->name;
                $rp->save();

                DB::commit();
            // }

            return redirect()->back()->with([
                'message'=>'Submitted successfuly.',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with([
                'message'=>'Error approving payment.',
                'alert-type' => 'error'
            ]);
        }
        // Insert into Registration Payment
        
    }

    public function delete($id)
    {
        //
    }
}
