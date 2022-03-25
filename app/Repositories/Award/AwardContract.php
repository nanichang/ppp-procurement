<?php
namespace App\Repositories\Award;

interface AwardContract{
    public function createAward($request);
    public function approveAward($request, $id);
    public function uploadAwardLetter($request, $id);
    public function cancellAward($request, $id);
    public function acceptAward($request, $id);
    public function awardNotification($request, $id);
}