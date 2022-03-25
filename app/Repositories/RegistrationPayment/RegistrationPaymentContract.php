<?php

namespace App\Repositories\RegistrationPayment;

interface RegistrationPaymentContract {
    public function create($request);
    public function findById($id);
    public function findAll();
    public function approvePayment($id);
}
