<?php

namespace App\Repositories\ProcurementPlan;

interface ProcurementPlanContract {
    public function create($request);
    public function getAllPlans($year);
    public function getPlansByTypeAndYear($type, $year);
    public function getPlans($type, $year);
    public function findById($id);
    public function findByMdaId($mda_id);
    public function update($request, $id);
    public function approveDeclinePlan($request);
    public function destroy($id);
}
