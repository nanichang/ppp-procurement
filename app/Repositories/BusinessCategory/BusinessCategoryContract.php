<?php
namespace App\Repositories\BusinessCategory;

interface BusinessCategoryContract{
    public function listAllBusinessCategories();
    public function allBusinessCategories();
    public function createBusinessCategory($request);
    public function destroy($request);

}