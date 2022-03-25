<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\Exception;
use App\Repositories\CategoryFee\CategoryFeeContract;

class CategoryRegistrationFeeController extends Controller{

    protected $repo;

    public function __construct(CategoryFeeContract $categoryFeeContract){
         $this->middleware('auth');
        $this->repo = $categoryFeeContract;
    }

    public function index() {
        try {
            $fees = $this->repo->listAllFee();

            if ($fees) {
                return view('admin.tools.registrationFee', ['fees' => $fees]);
            }
            else {
                return view('admin.tools.registrationFee', ['fees' => $fees]);
            }

        } catch (QueryException $e) {
            return view('admin.tools.registrationFee', ['fees' => $fees]);

        }

    }

    public function storeFee(Request $request) {

        try {
            $data = $request->all();
            $fee = $this->repo->create($data);
            $fees = $this->repo->listAllFee();


            if ($fee) {

                return redirect()->route('getFees')->with(['fees' => $fees]);
            }
            else {
                return redirect()->route('getFees')->with(['fees' => $fees]);
            }

        } catch (Exception $e) {
         return response()->json(['response' => $e->getMessage()], 500);

        }
    }

    public function delete(Request $request){

        try {

            $fee = $this->repo->destroy($request);
            $fees = $this->repo->listAllFee();


            if ($fee) {
                return redirect()->route('getFees')->with(['fees' => $fees]);
            }
            else {
                return redirect()->route('getFees')->with(['fees' => $fees]);
            }

        }
        catch (Exception $e) {
            return redirect()->route('getFees')->with(['fees' => $fees]);


        }

    }

}
