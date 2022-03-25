<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\QueryException;

use App\Repositories\BusinessSubCategory1\BusinessSubCategoryContract;
use App\Repositories\BusinessCategory\BusinessCategoryContract;


class BusinessSubCategory1Controller extends Controller
{
    protected $repo;
    protected $businessCategory;

    public function __construct(BusinessSubCategoryContract $businessSubCategoryContract, BusinessCategoryContract $categoryContract){
         $this->middleware('auth');
        $this->repo = $businessSubCategoryContract;
        $this->businessCategory = $categoryContract;
    }

    public function index() {
        try {
            $categories = $this->businessCategory->allBusinessCategories();
            $subcategories = $this->repo->allBusinessSubCategories();


            if ($subcategories) {
                return view('admin.tools.businessSubCategory', ['categories' => $categories, 'subcategories' => $subcategories]);
            }
            else {
                return view('admin.tools.businessSubCategory', ['categories' => $categories, 'subcategories' => $subcategories]);
            }
            
        } catch (QueryException $e) {
            return response()->json(['response' => $e->getMessage()], 500);
 
        }
       
    }

    public function storeBusinessCategory(Request $request) {

        try {
            $data = $request->all();
            $category= $this->repo->create($data);
            $categories = $this->businessCategory->allBusinessCategories();
            $subcategories = $this->repo->allBusinessSubCategories();


            if ($category) {

                return redirect()->route('fetchBusinessSubCategories')->with(['categories' => $categories, 'subcategories' => $subcategories]);
            }
            else {
                return redirect()->route('fetchBusinessSubCategories')->with(['categories' => $categories, 'subcategories' => $subcategories]);
            }
            
        } catch (Exception $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
    }

    public function delete(Request $request){

        try {
        
            $category = $this->repo->destroy($request);
            $categories = $this->businessCategory->allBusinessCategories();
            $subcategories = $this->repo->allBusinessSubCategories();

            if ($category) {
                return redirect()->route('fetchBusinessSubCategories')->with(['categories' => $categories, 'subcategories' => $subcategories]);
            }
            else {
                return redirect()->route('fetchBusinessSubCategories')->with(['categories' => $categories, 'subcategories' => $subcategories]);
            }
            
        } 
        catch (Exception $e) {
            return redirect()->route('fetchBusinessSubCategories')->with(['categories' => $categories, 'subcategories' => $subcategories]);

 
        }
        
    }

    public function getAllBusinessSubCategories() {

        try {
            $businessSubCategory = $this->repo->listBusinessSubCategory();

            if ($businessSubCategory) {
                return response()->json(['success'=> $businessSubCategory], 200);
            }
            else {
                return response()->json(['responseText' => 'Error retriving Business Sub Categories 1'], 500);
            }
            
        } catch (QueryException $e) {
         return response()->json(['response' => $e->getMessage()], 500);
 
        }
    }
}
