<?php

namespace App\Repositories\AdvertPayment;

interface AdvertPaymentContract {
    public function create($request);
    public function findById($id);
    public function approvePayment($request ,$id);
}
