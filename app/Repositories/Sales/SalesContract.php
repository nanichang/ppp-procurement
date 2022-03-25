<?php
namespace App\Repositories\Sales;

interface SalesContract
{
    public function find($id);

    public function listSales();

    public function create($requestData);

    public function listSalesByUserId();

    public function update($id, $requestData);

    public function destroy($id);

    public function listSalesByUserandAdvertId($advertId);

    public function mySales();

    public function totalSales();

    public function salesCount();

    public function getPassedByLot($id);

    public function getSubmittionsByMDAId($id);

    public function submittedApplications();

    public function getMDATransactions();

    public function updatePaymentStatus($id);

    public function listSalesByUser();
    public function viewAllSubmiitedSales($advertId, $advertLotId = null);
    public function uploadPaymentDocument($request);
    public function viewSingleSubmitedSaleByAdvertLotId($advertId);
    public function awardContractToContractor($request);
}
