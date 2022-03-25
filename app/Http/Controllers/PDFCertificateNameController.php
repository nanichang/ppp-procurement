<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\QueryException;
use App\Repositories\PdfCertificateName\PdfCertificateNameContract;

class PDFCertificateNameController extends Controller{
    protected $repo;

    public function __construct(PdfCertificateNameContract $pdfnameContract){
         $this->middleware('auth');
        $this->repo = $pdfnameContract;
    }

    public function index() {
        try {
            $names = $this->repo->listAllPDFName();

            if ($names) {
                return view('admin.tools.pdf_certificate_name', ['names' => $names]);
            }
            else {
                return view('admin.tools.pdf_certificate_name', ['names' => $names]);
            }

        } catch (\Exception $e) {
            return view('admin.tools.pdf_certificate_name', ['names' => $names]);

        }

    }

    public function storeName(Request $request) {

        try {
            $data = $request->all();
            $name = $this->repo->create($data);
            $names = $this->repo->listAllPDFName();


            if ($name) {

                return redirect()->route('getPDFNames')->with(['names' => $names]);
            }
            else {
                return redirect()->route('getPDFNames')->with(['names' => $names]);
            }

        } catch (\Exception $e) {
            return redirect()->route('getPDFNames')->with(['names' => $names]);

        }
    }

    public function delete(Request $request){

        try {

            $name = $this->repo->destroy($request);
            $names = $this->repo->listAllPDFName();


            if ($name) {
                return redirect()->route('getPDFNames')->with(['names' => $names]);
            }
            else {
                return redirect()->route('getPDFNames')->with(['names' => $names]);
            }

        } catch (\Exception $e) {
            return redirect()->route('getPDFNames')->with(['names' => $names]);


        }

    }
}
