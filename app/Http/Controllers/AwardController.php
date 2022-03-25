<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Repositories\Award\AwardContract;
use PDF;
use App\Award;
use App\Evaluator;
use DB;
use App\Contractor;
use App\Mda;

class AwardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AwardContract $awardContract)
    {
        $this->repo = $awardContract;
    }

    public function createAward(Request $request){
        try {
            $this->repo->createAward($request);
            $notification = array(
                'message' => 'Successful!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function approveAward(Request $request, $id){
        $this->middleware('auth');
        try {
            $this->repo->approveAward($request, $id);
            $notification = array(
                'message' => 'Successful!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function uploadAwardLetter(Request $request, $id){
        try {
            $this->repo->uploadAwardLetter($request, $id);
            $notification = array(
                'message' => 'Successful!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function contractorAwards(Request $request){
        $user = Auth::user();
        if (!$user) {
            return redirect('/');
        }
        $contractor = Contractor::where('user_id', $user->id)->first();
        $allAwards = Award::with('planAdvert')->with('contractor')
            ->with('advertLot')->where('contractor_id', $contractor->id)->get();
        $awards = [];
        foreach ($allAwards as $award) {
            if($award->status == 'awarded' || $award->status == 'accepted'){
                $awards[] = $award;
            }
        }
        return view('contractor.awards', compact('awards'));
    }

    public function contractorAward(Request $request, $id){
        $user = Auth::user();
        if (!$user) {
            return redirect('/');
        }
        $contractor = Contractor::where('user_id', $user->id)->first();
        $award = Award::with('planAdvert')->with('contractor')
            ->with('advertLot')->where('id', $id)->where('contractor_id', $contractor->id)->first();
        return view('contractor.award', compact('award'));
    }

    public function mdaAwards(Request $request){
        $user = Auth::user();
        if (!$user) {
            return redirect('/');
        }
        $mda = Mda::where('email', $user->email)->first();
        $awards = Award::with('planAdvert')->with('contractor')
            ->with('advertLot')->where('mda_id', $mda->id)->get();
        return view('mda.awards', compact('awards'));
    }

    public function adminAwards(Request $request){
        $user = Auth::user();
        if (!$user) {
            return redirect('/');
        }
        if($user->user_type != 'admin'){
            return redirect('/');
        }
        $awards = Award::with('planAdvert')->with('contractor')
            ->with('advertLot')->get();
        return view('admin.awards', compact('awards'));
    }

    public function downloadAwardPdf(Request $request, $id){
        $user = Auth::user();
        $evaluator = null;
        if(!$user){
            if (!$request->session()->has('evaluator_id')) {
                return redirect('/');
            }
            $evaluator_id = $request->session()->get('evaluator_id', null);
            $evaluator = Evaluator::find($evaluator_id);
            if(!$evaluator){
                $notification = array(
                    'message' => "Unathorized",
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification); 
            }
        }
        // DB::enableQueryLog();
        $award = Award::with('mda')->with('user')->with('contractor')->with('advertLot')
            ->with('planAdvert')->find($id);
        // dd(DB::getQueryLog());
        // ACL here
        // dd($award);
        if(!$award && $award->status != 'awarded' && $award->status != 'accepted'){
            $notification = array(
                'message' => "Invalid awards",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification); 
        }
        $pdf = PDF::loadView('awards/pdf', ['data' => $award]);
        return $pdf->download('award.pdf');
    }

    public function awardNotification(Request $request, $id){
        try {
            $this->repo->awardNotification($request, $id);
            $notification = array(
                'message' => 'Successful!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function cancellAward(Request $request, $id){
        $this->middleware('auth');
        try {
            $this->repo->cancellAward($request, $id);
            $notification = array(
                'message' => 'Successful!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function acceptAward(Request $request, $id){
        $this->middleware('auth');
        try {
            $this->repo->acceptAward($request, $id);
            $notification = array(
                'message' => 'Successful!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    
}