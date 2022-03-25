<?php

namespace App\Repositories\ProcurementYear;

interface ProcurementYearContract {
    public function create($request);
    public function getAll();
    public function disableYear($id);
    public function enableYear($id);
    public function deleteYear($request);
}
