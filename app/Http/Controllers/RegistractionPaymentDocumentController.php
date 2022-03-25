<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RegistractionPaymentDocument\RegistractionPaymentDocumentContract;

class RegistractionPaymentDocumentController extends Controller
{
    protected $repo;

    public function __construct(RegistractionPaymentDocumentContract $registractionPaymentDocumentContract) {
        $this->repo = $registractionPaymentDocumentContract;
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
