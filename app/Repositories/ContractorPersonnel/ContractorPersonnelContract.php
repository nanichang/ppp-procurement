<?php

namespace App\Repositories\ContractorPersonnel;

interface ContractorPersonnelContract {
    public function createPersonnel($rquest);
    public function getPersonnelsById();
    public function removePersonnel($request);
    public function find($id);

}