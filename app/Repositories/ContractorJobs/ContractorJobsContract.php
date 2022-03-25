<?php

namespace App\Repositories\ContractorJobs;

interface ContractorJobsContract {
    public function createJob($rquest);
    public function getJobsById();
    public function removeJob($request);
    public function getJobsByIdandCategory($category);
    public function find($id);
}