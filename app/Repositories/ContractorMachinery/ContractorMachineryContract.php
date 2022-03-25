<?php

namespace App\Repositories\ContractorMachinery;

interface ContractorMachineryContract {
    public function createMachinery($rquest);
    public function getMachineriesById();
    public function removeMachinery($request);
    public function find($id);
}