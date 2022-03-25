<?php

namespace App\Repositories\Contractor;

interface ContractorContract {
    public function createContractor($rquest);
    public function getUserById();
    public function getCompanyById();
    public function find($id);
    public function editPassword($request);
    public function updateAccountStatus($id, $value);
    public function getContractorProfile();
    public function allContractors();
}