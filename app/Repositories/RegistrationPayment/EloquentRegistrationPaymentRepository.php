<?php

namespace App\Repositories\RegistrationPayment;

use App\RegistractionPaymentDocument;
use App\RegistrationPayment;
use App\Repositories\RegistrationPayment\RegistrationPaymentContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Contractor;
class EloquentRegistrationPaymentRepository implements RegistrationPaymentContract {
    public function create($request)
    {
        try {
            DB::beginTransaction();
            $contractor = Contractor::where('user_id', auth()->user()->id)->first();
            $payment = new RegistrationPayment();
            $payment->payment_type = $request->payment_type;
            $payment->status = 'pending';
            $payment->contractor_id = $contractor->id;
            $payment->amount = $request->amount;
            $payment->save();

            if($request->has('document')){
                $file = $request->document;
                $filenamewithoutext = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filename = $filenamewithoutext.'_'.time().'.'.$extension;
                $directory = 'uploads/'.$filename;
                $uploaded = Storage::disk('s3')->put( $directory,  file_get_contents($file) , 'public');
                if($uploaded) {
                    $document = new RegistractionPaymentDocument();
                    $document->document = $directory;
                    $document->registration_payment_id = $payment->id;
                    $document->contractor_id = $contractor->id;
                    $document->save();
                }
            }

            DB::commit();
            return 1;
        } catch(\Exception $e) {
            DB::rollback();
            return 0;

        }
        
    }

    public function findById($id)
    {
        return RegistrationPayment::where('id', $id)->first();
    }

    public function findAll() {
        return RegistrationPayment::with('contractor')->with('documents')->get();
    }

    public function approvePayment($id)
    {
        $payment = $this->findById($id);
        $payment->status = 'verified';
        $payment->approved_by = auth()->user()->name;
        $payment->save();
    }
}
