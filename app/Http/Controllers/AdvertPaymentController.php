<?php

namespace App\Http\Controllers;

use App\Contractor;
use App\Repositories\PlanAdvert\PlanAdvertContract;
use Illuminate\Http\Request;
use App\Repositories\AdvertPayment\AdvertPaymentContract;

class AdvertPaymentController extends Controller
{
    protected $repo;
    protected $planRepo;
    public function __construct(AdvertPaymentContract $advertPaymentContract, PlanAdvertContract $planAdvertContract) {
        $this->repo = $advertPaymentContract;
        $this->planRepo = $planAdvertContract;
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        $user = auth()->user();
        $contractor = Contractor::where('user_id', $user->id)->first();
        return view('advertpayment.create', compact('contractor'));
    }

    public function store(Request $request)
    {
        try {
            $payment = $this->repo->create($request);
            if ($payment == 1) {
                $notification = array(
                    'message' => 'Payment Document uploaded Succesfully',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            } else {
                $notificationErr = array(
                    'message' => 'Payment Document uploaded Succesfully',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notificationErr);
            }
        } catch (Exception $e) {
            $notificationErr = array(
                'message' => 'Payment Document uploaded Succesfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notificationErr);
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

    public function update(Request $request, $id)
    {
        //
    }

    public function delete($id)
    {
        //
    }
}
