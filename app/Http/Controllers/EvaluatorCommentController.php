<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluatorCommentController extends Controller
{
    public function storeReport($request, $evaluator) {
        $sale = $this->find($request->sale_id);
        $commnent = new EvaluatorComment();
        $comment->evaluator_name;

        $sale->report = $request->report;
        $sale->reported_by = $evaluator->name;
        $sale->passed_evaluation = true;
        return $sale->save();        
    }
}
