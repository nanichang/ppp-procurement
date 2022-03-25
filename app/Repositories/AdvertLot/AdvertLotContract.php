<?php
namespace App\Repositories\AdvertLot;

interface AdvertLotContract{
    public function createAdvertLot($request);
    public function listAllAdvertLotsByStatus($status);
    public function listAllAdvertLots();
    public function listAdvertLotsByUserId();
    public function removeAdvertLot($request);
    public function listAdsByUserIdandCategory($categoryId);
    public function countAdvertsByCategory($categoryId);
}