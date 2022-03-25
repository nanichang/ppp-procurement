<?php

namespace App\Repositories\AdvertPayment;

use App\AdvertPayment;
use App\AdvertPaymentDocument;
use Illuminate\Support\Facades\DB;
use App\Repositories\AdvertPayment\AdvertPaymentContract;

class EloquentAdvertPaymentRepository implements AdvertPaymentContract {
    public function create($request)
    {
        try {
            DB::beginTransaction();
            $payment = new AdvertPayment();
            $payment->payment_type = $request->payment_type;
            $payment->status = 'pending';
            $payment->contractor_id = $request->contractor_id;
            $payment->amount = $request->amount;
            $payment->plan_advert_id = $request->plan_advert_id;
            $payment->save();

            if($request->has('document')){
                $file = $request->document;
                $filenamewithoutext = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filename = $filenamewithoutext.'_'.time().'.'.$extension;
                $directory = 'uploads/'.$filename;
                $uploaded = Storage::disk('s3')->put( $directory,  file_get_contents($file) , 'public');
                if($uploaded) {
                    $url = $uploaded;
                    $document = new AdvertPaymentDocument();
                    $document->document = $directory;
                    $document->advert_payment_id = $payment->id;
                    $document->contractor_id = $request->contractor_id;
                    $document->save();
                }
            }            
            DB::commit();
            return 1;
        } catch (\Exception $e) {
            DB::rollBack();
            return 0;
        }

    }

    public function findById($id)
    {
        return AdvertPayment::where('id', $id)->first();
    }

    public function approvePayment($request ,$id)
    {
        $payment = $this->findById($id);
        $payment->status = 'verified';
        $payment->approved_by = $request->approved_by ?? 'N/A';
        $payment->save();
    }
}
