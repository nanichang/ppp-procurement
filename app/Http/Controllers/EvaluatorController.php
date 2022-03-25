<?php

namespace App\Http\Controllers;

use App\Repositories\PlanAdvert\PlanAdvertContract;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Repositories\Evaluator\EvaluatorContract;
use App\Repositories\MDA\MdaContract;
use App\Repositories\Sales\SalesContract;
use Auth;
use App\AdvertLot;
use App\EvaluatorComment;
use App\EvaluatorLotEvaluation;
use DB;
use App\AdvertCriteria;
use App\Contractor;
use App\Sales;
use App\Award;


class EvaluatorController extends Controller
{
    protected $repo;
    protected $mdaRepo;
    protected $planAdvertRepo;
    protected $salesRepo;

    public function __construct(
        EvaluatorContract $evaluatorContract,
        MdaContract $mdaContract,
        PlanAdvertContract $planAdvertContract,
        SalesContract $salesContract
    ) {
        $this->repo = $evaluatorContract;
        $this->mdaRepo = $mdaContract;
        $this->planAdvertRepo = $planAdvertContract;
        $this->salesRepo = $salesContract;
    }

    

    public function create(Request $request)
    {
        $this->middleware('auth');
        $lot = AdvertLot::with('planAdvert')->with('awards')->where('id', $request->lot_id)->first();
        $user = Auth::user();
        $mda = $this->mdaRepo->findByEmail($user->email);
        $evaluators = $this->repo->getAllByLot($request->lot_id);
        $mdas = $this->mdaRepo->allMdas();
        if($request->isMethod('post')) {
            try {
                $evaluator = $this->repo->create($request);
                if ($evaluator == 1) {
                    return redirect()->back()->with([
                        'message'=>'Evaluator invited Successfully',
                        'alert-type' => 'success'
                    ]);
                } else {
                    return redirect()->back()->with([
                        'message'=>'Error saving record... Please try again.',
                        'alert-type' => 'error'
                    ]);
                }
            } catch (QueryException $e) {
                return redirect()->back()->with([
                    'message' => $e->getMessage(),
                    'alert-type' => 'error'
                ]);
            }
        }
        return view('evaluator.index', compact('evaluators', 'mdas', 'lot'));
    }

    public function resendInvite($code)
    {
        $this->middleware('auth');
        try {
            $evaluator = $this->repo->resendInvitation($code);
            if ($evaluator == 1) {
                return redirect()->back()->with([
                    'message'=>'Invitation sent Successfully',
                    'alert-type' => 'success'
                ]);
            } else {
                return redirect()->back()->with([
                    'message'=>'Error sending invite... Please try again.',
                    'alert-type' => 'error'
                ]);
            }
        } catch (QueryException $e) {
            return redirect()->back()->with([
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    public function delete($id)
    {
        $this->middleware('auth');
        try {
            $evaluator = $this->repo->destroy($id);
            if ($evaluator == 1) {
                return redirect()->back()->with([
                    'message'=>'Deleted Successfully',
                    'alert-type' => 'success'
                ]);
            } else {
                return redirect()->back()->with([
                    'message'=>'Error Deleting record... Please try again.',
                    'alert-type' => 'error'
                ]);
            }
        } catch (QueryException $e) {
            return redirect()->back()->with([
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    public function evaluatorAwards(Request $request){
        if (!$request->session()->has('evaluator_id')) {
            return redirect('/');
        }
        $id = $request->session()->get('evaluator_id', null);
        $evaluator = $this->repo->findById($id);
        $advertLot = AdvertLot::where('id',$evaluator->advert_lot_id)->first();
        $awards = Award::with('planAdvert')->with('contractor')->with('advertLot')
            ->where('advert_lot_id', $advertLot->id)->get();
        $approvedAward = Award::with('planAdvert')->where('advert_lot_id', $advertLot->id)->where('status', 'approved')->first();
        $awardedAward = Award::with('planAdvert')->where('advert_lot_id', $advertLot->id)->where('status', 'awarded')->first();
        return view('evaluator.awards', compact('evaluator', 'advertLot', 'awards', 'approvedAward', 'awardedAward', 'evaluator'));
    }

    public function dashboard(Request $request)
    {
        if (!$request->session()->has('evaluator_id')) {
            return redirect('/');
        }
        $id = $request->session()->get('evaluator_id', null);
        $evaluator = $this->repo->findById($id);
        
        $advertLot = AdvertLot::where('id',$evaluator->advert_lot_id)->first();
        $comments = EvaluatorComment::where('advert_lot_id', $advertLot->id )->get();

        $mda = $this->mdaRepo->find($evaluator->mda_id);
        $plans = $this->planAdvertRepo->findByMdaId($mda->id);
        $sales = $this->salesRepo->getPassedByLot($advertLot->id);
        return view('evaluator.dashboard', compact('mda', 'plans', 'sales', 'evaluator', 'advertLot', 'comments'));
    }

    public function results(Request $request)
    {
        if (!$request->session()->has('evaluator_id')) {
            return redirect('/');
        }
        $id = $request->session()->get('evaluator_id', null);
        $evaluator = $this->repo->findById($id);
        $advertLot = AdvertLot::with('planAdvert')->where('id',$evaluator->advert_lot_id)->first();
        $advertCriterias = $advertLot->planAdvert->advertCriterias;
        $results = [];
        foreach ($advertCriterias as $criteria) {
            if($criteria->value_type == 'numeric'){
                $results[$criteria->id] = EvaluatorLotEvaluation::where('advert_criteria_id', $criteria->id)
                ->where('type', 'numeric')
                ->leftJoin('contractors', 'contractors.id', '=', 'evaluator_lot_evaluations.contractor_id')
                ->select(array('contractor_id', 'contractors.company_name as contractor',
                    DB::raw('AVG(evaluator_lot_evaluations.numeric_value) as score')
                    ))
                ->groupBy('contractor_id')
                ->orderBy('score', 'DESC')->take(5)->get();
            }else{
                $results[$criteria->id] = EvaluatorLotEvaluation::with('contractor')->where('advert_criteria_id', $criteria->id)
                ->where('type', 'binary')
                ->leftJoin('contractors', 'contractors.id', '=', 'evaluator_lot_evaluations.contractor_id')
                ->select(array('contractor_id', 'contractors.company_name as contractor',
                    DB::raw('SUM(evaluator_lot_evaluations.binary_value) as score')
                ))
                ->groupBy('contractor_id')
                ->orderBy('score', 'DESC')->take(5)->get();
            }
        }
        return view('evaluator.results', compact('evaluator', 'advertLot', 'advertCriterias', 'results'));
    }

    public function contractorResult(Request $request, $contractorId)
    {
        if (!$request->session()->has('evaluator_id')) {
            return redirect('/');
        }
        $id = $request->session()->get('evaluator_id', null);
        $evaluator = $this->repo->findById($id);
        $advertLot = AdvertLot::with('planAdvert')->where('id',$evaluator->advert_lot_id)->first();
        $contractor = Contractor::find($contractorId);
        $sales = Sales::where('advert_lot_id', $advertLot->id)->where('contractor_id', $contractorId)->first();
        $activeAward = Award::where('advert_lot_id', $advertLot->id)->where('status', '!=', 'cancelled')->first();
        $advertCriterias = $advertLot->planAdvert->advertCriterias;
        $results = [];
        foreach ($advertCriterias as $criteria) {
            if($criteria->value_type == 'numeric'){
                $results[$criteria->id] = EvaluatorLotEvaluation::where('advert_criteria_id', $criteria->id)
                ->where('type', 'numeric')
                ->where('contractor_id', $contractorId)
                ->leftJoin('contractors', 'contractors.id', '=', 'evaluator_lot_evaluations.contractor_id')
                ->select(array('contractor_id', 'contractors.company_name as contractor',
                    DB::raw('AVG(evaluator_lot_evaluations.numeric_value) as score')
                    ))
                ->groupBy('contractor_id')
                ->orderBy('score', 'DESC')->get();
            }else{
                $results[$criteria->id] = EvaluatorLotEvaluation::with('contractor')->where('advert_criteria_id', $criteria->id)
                ->where('type', 'binary')
                ->where('contractor_id', $contractorId)
                ->leftJoin('contractors', 'contractors.id', '=', 'evaluator_lot_evaluations.contractor_id')
                ->select(array('contractor_id', 'contractors.company_name as contractor',
                    DB::raw('SUM(evaluator_lot_evaluations.binary_value) as score')
                ))
                ->groupBy('contractor_id')
                ->orderBy('score', 'DESC')->get();
            }
        }
        return view('evaluator.contractor_result', compact('evaluator', 'advertLot', 'sales', 'activeAward', 'advertCriterias', 'results', 'contractor'));
    }

    public function showResult(Request $request, $criteriaId)
    {
        if (!$request->session()->has('evaluator_id')) {
            return redirect('/');
        }
        $id = $request->session()->get('evaluator_id', null);
        $evaluator = $this->repo->findById($id);
        $advertLot = AdvertLot::with('planAdvert')->where('id',$evaluator->advert_lot_id)->first();
        $criteria = AdvertCriteria::find($criteriaId);
        $results = [];
        if($criteria->value_type == 'numeric'){
            $results[$criteria->id] = EvaluatorLotEvaluation::where('advert_criteria_id', $criteria->id)
            ->where('type', 'numeric')
            ->leftJoin('contractors', 'contractors.id', '=', 'evaluator_lot_evaluations.contractor_id')
            ->select(array('contractor_id', 'contractors.company_name as contractor',
                DB::raw('AVG(evaluator_lot_evaluations.numeric_value) as score')
                ))
            ->groupBy('contractor_id')
            ->orderBy('score', 'DESC')->get();
        }else{
            $results[$criteria->id] = EvaluatorLotEvaluation::with('contractor')->where('advert_criteria_id', $criteria->id)
            ->where('type', 'binary')
            ->leftJoin('contractors', 'contractors.id', '=', 'evaluator_lot_evaluations.contractor_id')
            ->select(array('contractor_id', 'contractors.company_name as contractor',
                DB::raw('SUM(evaluator_lot_evaluations.binary_value) as score')
            ))
            ->groupBy('contractor_id')
            ->orderBy('score', 'DESC')->get();
        }
        return view('evaluator.show-result', compact('evaluator', 'advertLot', 'criteria', 'results'));
    }

    public function evaluatorOpenBids(Request $request)
    {
        if (!$request->session()->has('evaluator_id')) {
            return redirect('/');
        }
        $id = $request->session()->get('evaluator_id', null);
        $evaluator = $this->repo->findById($id);
        
        $advertLot = AdvertLot::with('planAdvert')->with('awards')->where('id',$evaluator->advert_lot_id)->first();
        $comments = EvaluatorComment::where('advert_lot_id', $advertLot->id )->get();
        $awarded = false;
        foreach($advertLot->awards as $award){
            if($award->status == 'awarded' || $award->status == 'accepted'){
                $awarded = true;
                break;
            }
        }
        $mda = $this->mdaRepo->find($evaluator->mda_id);
        $plans = $this->planAdvertRepo->findByMdaId($mda->id);
        $sales = $this->salesRepo->viewAllSubmiitedSales($advertLot->plan_advert_id, $advertLot->id, $evaluator);
        $advertCriterias = $advertLot->planAdvert->advertCriterias;
        return view('evaluator.openbids', compact('mda', 'plans', 'sales', 'evaluator', 'advertLot', 'comments', 'advertCriterias', 'awarded'));
    }

    public function evaluateContractor(Request $request)
    {
        if (!$request->session()->has('evaluator_id')) {
            return redirect('/');
        }
        $id = $request->session()->get('evaluator_id', null);
        $evaluator = $this->repo->findById($id);
        
        $advertLot = AdvertLot::with('planAdvert')->where('id', $evaluator->advert_lot_id)->first();
        $mda = $this->mdaRepo->find($evaluator->mda_id);
        DB::beginTransaction();
        try{
            EvaluatorLotEvaluation::where('contractor_id', $request->contractor_id)
            ->where('advert_lot_id', $request->advert_lot_id)
            ->where('evaluator_id', $evaluator->id)->delete();
            $criteria = $advertLot->planAdvert->advertCriterias;
            for($i = 0; $i < count($criteria); $i++){
                $item = $criteria[$i];
                $iitems = $request->criterias;
                if($item->required && count($iitems) > 0 && strlen($iitems[$i]) == null){
                    return back()->with('error', 'Please fill up the required field');
                }
                $elv = new EvaluatorLotEvaluation;
                $elv->advert_criteria_title = $item->title;
                $elv->advert_criteria_description = $item->description;
                $elv->evaluator_name = $evaluator->name;
                $elv->advert_lot_id = $request->advert_lot_id;
                $elv->type = $item->value_type;
                if($item->value_type == "binary"){
                    $elv->binary_value = ($iitems[$i] == "No" ? false : true);
                }else{
                    $elv->numeric_value = $iitems[$i];
                }
                $elv->evaluator_id = $evaluator->id;
                $elv->advert_criteria_id = $item->id;
                $elv->contractor_id = $request->contractor_id;
                $elv->sale_id = $request->sale_id;
                $elv->save();
            }
            // dd($request->all());
            DB::commit();
            return back()->with('success', 'Evaluation done successfully');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error', 'Error performing evaluations');
        }
    }

    public function comments(Request $request)
    {
        if (!$request->session()->has('evaluator_id')) {
            return redirect('/');
        }
        $id = $request->session()->get('evaluator_id', null);
        $evaluator = $this->repo->findById($id);
        
        $advertLot = AdvertLot::where('id',$evaluator->advert_lot_id)->first();
        $comments = EvaluatorComment::where('advert_lot_id', $advertLot->id )->get();

        $mda = $this->mdaRepo->find($evaluator->mda_id);
        $plans = $this->planAdvertRepo->findByMdaId($mda->id);
        $sales = $this->salesRepo->getPassedByLot($advertLot->id);
        return view('evaluator.comments', compact('mda', 'plans', 'sales', 'evaluator', 'advertLot', 'comments'));
    }


    public function postComment(Request $request)
    {
        $id = $request->session()->get('evaluator_id', null);
        $evaluator = $this->repo->findById($id);
        $comment = new EvaluatorComment();
        $comment->evaluator_name = $evaluator->name;
        $comment->advert_lot_id = $evaluator->advert_lot_id;
        $comment->comment = $request->comment;
        $comment->evaluator_id = $evaluator->id;
        $comment->save();
        return redirect()->back()->with('success', 'Evaluator Comment saved successfully');
    }

}
