<?php

namespace App\Repositories\Compliance;

interface ComplianceContract {
    public function createCompliance($request);
    public function getCompliancesById();
    public function listAllCompliance();
}