<?php

namespace App\Repositories\ContractorCategory;

interface ContractorCategoryContract {
    public function createCategory($rquest);
    public function getCategoriesById();
    public function getCategories();
    public function removeCategory($request);
    public function find($id);
}