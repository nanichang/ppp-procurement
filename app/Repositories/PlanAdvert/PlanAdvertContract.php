<?php

namespace App\Repositories\PlanAdvert;

interface PlanAdvertContract {
    public function create($request);
    public function getAll();
    public function getById($id);

    public function getByProcurementPlanId($id);
    public function approveAdvertDocuments($request, $id);
    public function disapproveAdvert($request, $id);
    public function removeAdvert($request);
    public function listAdvertsByPlanId($planId);

    //Mda
    public function getMDAAdverts($id);
    public function getMDAAdvertsByCategory($mdaId, $catId);
    public function editMDAAdvert($request);
    public function getMDAOpeningAdverts($id);
    public function awardContractToContractor($request);

    // Admin
    public function listAllAdverts();
    public function updateAdvertStatus($advertId, $status);
    public function getAllByCategory($id);
    public function getAllOpeningAdverts();

    // Contractor
    public function listAllPublishedAdverts();
    public function listAllPublishedAdvertsByCategory($Id);
    public function getPublishedAdvertById($id);
    public function findByMdaId($id);
    
}
