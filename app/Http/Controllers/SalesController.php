<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\Exception;

use App\Repositories\Sales\SalesContract;
use Illuminate\Support\Facades\Auth;
use App\User;
use PDF;



class SalesController extends Controller{
    protected $repo;

    public function __construct(SalesContract $salesContract){
         $this->middleware('auth');
        $this->repo = $salesContract;
    }


    public function storeSales(Request $request) {

        try {
            $data = (object)$request->all();
            $sales = $this->repo->create($data);

            if ($sales) {
                return back()->with('success', 'Sales Added Succesfully.');
            }
            else {
                return redirect()->back()->with('error', 'Failed to Purchase.');
            }

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to Purchase.');

        }
    }

    // public function getSalesByUserId() {

    //     try {
    //         $sales = $this->repo->listSalesByUserId();

    //         if ($sales) {
    //             return response()->json(['success'=> $qualification], 200);
    //         }
    //         else {
    //             return redirect()->back()->with('error', 'Failed to Purchase.');
    //         }

    //     } catch (Exception $e) {
    //         return redirect()->back()->with('error', 'Failed to Purchase.');

    //     }
    // }

    public function delete($id){
        try {

            $sales = $this->repo->destroy($id);

            if ($sales) {

                 return back()->with(['success'=>'sales deleted Succesfully.']);
            }
            else {
                return back()->with(['responseText' => 'Error adding Company Ownership']);
            }

        } catch (Exception $e) {
            return back()->with(['responseText' => 'Error adding Company Ownership']);

        }

    }

    public function getSalesByUserandAdvert($advertId) {
          $sales =  $this->repo->listSalesByUserandAdvertId($advertId);
        return view('contractor.PurchasedBids', ['sales' => $sales]);
    }


    public function getSalesByUser() {
        $sales =  $this->repo->listSalesByUser();
      return view('contractor.PurchasedBids', ['sales' => $sales]);
    }
    
    public function getBidDocumentsByUser() {
        $sales =  $this->repo->listSalesByUser();
        return view('contractor.BidDocuments', ['sales' => $sales]);
    }

    public function uploadPaymentDocument(Request $request) {
        try {
            $sales = $this->repo->uploadPaymentDocument($request);
            if ($sales) {
                return back()->with(['success'=>'Payment Document uploaded Succesfully.']);
            } else {
                return back()->with(['error' => 'Error uploading Payment Document']);
            }
        } catch (Exception $e) {
            return back()->with(['error' => 'Error uploading Payment Document']);
        }
    }
    
    public function uploadContractorTenderDocument(Request $request) {
        try {
            if(!$request->has('contractor_tender_document')) {
                return redirect()->back()->with(['message'=> 'Tender Document must be uploaded.', 'alert-type' => 'error']);
            }

            $sales = $this->repo->uploadContractorTenderDocument($request);
            if ($sales) {
                return back()->with(['success'=>'Contractor Tender Document uploaded Succesfully.']);
            } else {
                return back()->with(['error' => 'Error uploading COntractor Tender Document']);
            }
        } catch (Exception $e) {
            return back()->with(['error' => 'Error uploading Contractor Tender Document']);
        }
    }


    public function downloadPDF($salesId){
        $user = User::where('id', Auth::user()->id)->get()->first();
        $data = $this->repo->find($salesId);
        $pdf = PDF::loadView('contractor/PurchasedBidPDF', compact('user'), ['data' => $data]);
        return $pdf->download('tender.pdf');
      }

    public function getMDATransactions() {
        $transactions = $this->repo->getMDATransactions();
        return view('mda.transactions', ['transactions' => $transactions]);
    }


    public function updatePaymentStatus($id) {
        $this->repo->updatePaymentStatus($id);
        return back();
    }

}
