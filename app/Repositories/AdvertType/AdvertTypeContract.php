<?php
namespace App\Repositories\AdvertType;

interface AdvertTypeContract{
    public function listAllAdvertTypes();
    public function allAdvertTypes();
    public function createAdvertType($request);
    public function destroy($request);

}