<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\QueryException;
use App\Repositories\TenderEligibility\TenderEligibilityContract;

class TenderEligibilityController extends Controller{

    protected $repo;

    public function __construct(TenderEligibilityContract $eligibilityContract){
         $this->middleware('auth');
        $this->repo = $eligibilityContract;
    }

    public function index() {
        try {
            $names = $this->repo->listAllEligibility();

            if ($names) {
                return view('admin.tools.addEligibility', ['names' => $names]);
            }
            else {
                return view('admin.tools.addEligibility', ['names' => $names]);
            }

        } catch (Exception $e) {
            return view('admin.tools.addEligibility', ['names' => $names]);

        }

    }

    public function storeName(Request $request) {

        try {
            $data = $request->all();
            $name = $this->repo->create($data);
            $names = $this->repo->listAllEligibility();


            if ($name) {

                return redirect()->route('getEligibility')->with(['names' => $names]);
            }
            else {
                return redirect()->route('getEligibility')->with(['names' => $names]);
            }

        } catch (Exception $e) {
            return redirect()->route('getEligibility')->with(['names' => $names]);

        }
    }

    public function delete(Request $request){

        try {

            $name = $this->repo->destroy($request);
            $names = $this->repo->listAllEligibility();


            if ($name) {
                return redirect()->route('getEligibility')->with(['names' => $names]);
            }
            else {
                return redirect()->route('getEligibility')->with(['names' => $names]);
            }

        } catch (Exception $e) {
            return redirect()->route('getEligibility')->with(['names' => $names]);


        }

    }
    //
}
