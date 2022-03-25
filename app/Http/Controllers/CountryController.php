<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\QueryException;

use App\Repositories\Countries\CountriesContract;
use App\Repositories\States\StateContract;

class CountryController extends Controller
{
    protected $repo;

    public function __construct(CountriesContract $countryContract, StateContract $stateContract){
         $this->middleware('auth');
        $this->repo = $countryContract;
        $this->state = $stateContract;
    }

    public function getAllCountries() {

        try {
            $countries = $this->repo->listAllCountries();

            if ($countries) {
                return response()->json(['success'=> $countries], 200);
            }
            else {
                return response()->json(['responseText' => 'Error retriving countries'], 500);
            }
            
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
    }

    public function getAllStates() {

        try {
            $states = $this->state->listAllStates();

            if ($states) {
                return response()->json(['success'=> $states], 200);
            }
            else {
                return response()->json(['responseText' => 'Error retriving states'], 500);
            }
            
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
    }
}
