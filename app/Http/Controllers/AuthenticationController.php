<?php

namespace App\Http\Controllers;

use App\Evaluator;
use Illuminate\Http\Request;
use App\Repositories\Authentication\AuthenticationContract;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthenticationController extends Controller
{
    protected $repo;

    public function __construct(AuthenticationContract $authenticationContract) {
        $this->repo = $authenticationContract;
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $notification = array(
                'message' => 'Successfully logged in',
                'alert-type' => 'success'
            );
            return redirect()->intended('dashboard')->with($notification);
        } else {
            // Authentication failed...
            $notification = array(
                'message' => 'Failed to log in, please check your credentials and try again',
                'alert-type' => 'error'
            );
            Session::flash('error', 'Failed to login');
            return redirect()->back()->with($notification);
        }
    }

    public function showEvaluatorLogin(Request $request)
    {
        if(!$request->has('code')){
            return redirect('/');
        }
        if(!$request->has('email')){
            return redirect('/');
        }
        $id = $request->code;
        $email = $request->email;
        return view('evaluator.login', compact('email', 'id'));
    }

    public function postEvaluatorlogin(Request $request)
    {
        $evaluator = Evaluator::where('email', $request->email)->where('code', $request->code)
        ->where('id', $request->id)->first();
        if (!$evaluator) {
            $notification = array(
                'message' => 'Failed to log in, please check your credentials and try again',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $request->session()->put('evaluator_id', $evaluator->id);
        $request->session()->put('evaluator_code', $evaluator->code);
        $request->session()->put('evaluator_email', $evaluator->email);
        $request->session()->put('evaluator_advert_lot_id', $evaluator->advert_lot_id);
        $request->session()->put('evaluator_plan_advert_id', $evaluator->plan_advert_id);
        $request->session()->put('evaluator_mda_id', $evaluator->mda_id);
        $notification = array(
            'message' => 'Successfully logged in',
            'alert-type' => 'success'
        );
        return redirect()->route('evaluator.dashboard')->with($notification);
    }

    public function evaluatorLogout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

}
