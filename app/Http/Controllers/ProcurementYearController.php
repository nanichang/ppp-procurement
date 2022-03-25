<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProcurementYear\ProcurementYearContract;

class ProcurementYearController extends Controller
{
    protected $repo;

    public function __construct(ProcurementYearContract $procurementYearContract) {
        $this->repo = $procurementYearContract;
    }

    public function index()
    {
        $allYears = $this->repo->getAll();
        return view('procurementyear.index')->with('allYears', $allYears);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        try {
            $data = $request->all();
            $found = checkIfyearExist($data);
            if(isset($found) && $found->count() > 0) {
                return response()->json(['error' => "Year {$request->year} already exist"], 500);
            }
            $year = $this->repo->create($data);
            if ($year == 1) {
                return redirect()->back()->with('success', 'Year Added Succesfully.');
            }
            else {
                return response()->json(['error' => 'Error adding Year'], 500);
            }

        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);

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

    public function disable($id)
    {
        try {
            $year = $this->repo->disableYear($id);

            if ($year == 1) {
                return redirect()->back()->with('success', 'Year Disabled Succesfully.');
            }
            else {
                return response()->json(['responseText' => 'Error Disabling Year'], 500);
            }

        } catch (QueryException $e) {
            return response()->json(['response' => $e->getMessage()], 500);

        }
    }

    public function enable($id)
    {
        try {
            $year = $this->repo->enableYear($id);

            if ($year == 1) {
                return redirect()->back()->with('success', 'Year Disabled Succesfully.');
            }
            else {
                return response()->json(['error' => 'Error Disabling Year'], 500);
            }

        } catch (QueryException $e) {
            return response()->json(['response' => $e->getMessage()], 500);

        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function delete(Request $request)
    {
        try {
            $isActive = checkActiveYear($request->all());
            if($isActive == 1) {
                return response()->json(['error' => 'Active year can\'t be deleted, disable year first'], 500);
            }
            $year = $this->repo->deleteYear($request->all());     
            if ($year) {
                return response()->json(['success'=>' Year Deleted Successfully'], 200);
             } else {  
                return response()->json(['error' => 'Failed to Delete'], 500);
             }
        } catch (\Exception $e) {
         return response()->json(['response' => $e->getMessage()], 500);
        }
    }
}
