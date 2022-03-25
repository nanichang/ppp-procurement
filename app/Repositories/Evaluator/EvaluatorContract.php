<?php

namespace App\Repositories\Evaluator;

interface EvaluatorContract {
    public function create($request);
    public function getAll();
    public function findById($id);
    public function getAllByMDA($id);
    public function getAllByLot($id);
    public function findByCode($code);
    public function findByEmailCodeAndId($request);
    public function resendInvitation($evaluator);
    public function destroy($id);
}
