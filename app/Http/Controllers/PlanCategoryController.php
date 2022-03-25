<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PlanCategory\PlanCategoryContract;

class PlanCategoryController extends Controller
{
    protected $repo;

    public function __construct(PlanCategoryContract $planCategoryContract) {
        $this->repo = $planCategoryContract;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
