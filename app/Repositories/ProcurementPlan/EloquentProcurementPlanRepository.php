<?php

namespace App\Repositories\ProcurementPlan;

use App\Mda;
use App\Notifications\SendMdaApprovalNotification;
use App\Notifications\SendMdaDeclineNotification;
use App\Repositories\ProcurementPlan\ProcurementPlanContract;
use App\ProcurementPlan;

class EloquentProcurementPlanRepository implements ProcurementPlanContract {
    public function create($request){
        $plan = new ProcurementPlan();
        $plan->plan_title = $request->plan_title;
        $plan->project_description = $request->project_description;
        $plan->package_number = $request->package_number ? $request->package_number : "N/A";
        $plan->lot_number = $request->lot_number ? $request->lot_number : "N/A";
        $plan->lumpsum = $request->lumpsum;
        $plan->procurement_method = $request->procurement_method;
        $plan->budgetry_amount = $request->budgetry_amount;
        $plan->pre_post_qualification = $request->pre_post_qualification;
        $plan->approval_threshold = $request->approval_threshold;
        $plan->prep_submissions_by_mda = $request->prep_submissions_by_mda;
        $plan->mda_approval = $request->mda_approval;
        $plan->advertisement_for_pre_qualification = $request->advertisement_for_pre_qualification;
        $plan->bid_invitation_date = $request->bid_invitation_date;
        $plan->bid_closing_date = $request->bid_closing_date;
        $plan->submission_bid_eval_rpt = $request->submission_bid_eval_rpt;
        $plan->mda_approval_2 = $request->mda_approval_2;
        $plan->contract_amount_certified = $request->contract_amount_certified;
        $plan->sec_approval = $request->sec_approval;
        $plan->date_of_contract_offer = $request->date_of_contract_offer;
        $plan->date_of_contract_signature = $request->date_of_contract_signature;
        $plan->mobilization_advance_payment = $request->mobilization_advance_payment;
        $plan->substantial_completion = $request->substantial_completion;
        $plan->final_acceptance = $request->final_acceptance;
        $plan->final_cost = $request->final_cost;
        $plan->action_party = $request->action_party;
        $plan->champion = $request->champion;

        $plan->contract_type = $request->contract_type;
        $plan->contract_amount = $request->contract_amount;
        $plan->selection_method = $request->selection_method;
        $plan->qualification = $request->qualification;
        $plan->review = $request->review;
        $plan->prep_and_submission_by_mda = $request->prep_and_submission_by_mda;
        $plan->advertisement = $request->advertisement;
        $plan->lead_time_before_submission = $request->lead_time_before_submission;
        $plan->closing_date = $request->closing_date;
        $plan->opening_date = $request->opening_date;
        $plan->tech_evaluation_report = $request->tech_evaluation_report;
        $plan->opening_of_fin_proposal = $request->opening_of_fin_proposal;
        $plan->submission_of_evaluation_report_technical_financial = $request->submission_of_evaluation_report_technical_financial;
        $plan->negotiations = $request->negotiations;
        $plan->mda_approval_No_objection_date = $request->mda_approval_No_objection_date;
        $plan->certifiable_amount_per_contract = $request->certifiable_amount_per_contract;
        $plan->submission_of_draft_report = $request->submission_of_draft_report;
        $plan->submission_of_final_report = $request->submission_of_final_report;

        $plan->estimated_amount_in_naira = $request->estimated_amount_in_naira;
        $plan->arrival_of_goods = $request->arrival_of_goods;
        $plan->final_inspection_acceptance = $request->final_inspection_acceptance;
        $user = auth()->user();
        $mda = Mda::where('email', $user->email)->first();
        $plan->mda_id = $mda->id;
        $plan->business_category_id = $request->business_category_id;
        $plan->year_id = $request->year_id;
        $plan->approved_by = $request->approved_by ?? "N/A";
        $plan->save();
        return 1;
    }

    public function getAllPlans($year){
        $user = auth()->user();
        if($user->user_type == "admin"){
            return ProcurementPlan::where('year_id', $year->id)->get();
        }else{
            $mda = Mda::where('email', $user->email)->first();
            return ProcurementPlan::where('year_id', $year->id)->where('mda_id', $mda->id)->get();
        }
    }

    public function getPlans($type, $year)
    {
        $user = auth()->user();
        if($user->user_type == "admin"){
            return ProcurementPlan::where('business_category_id', $type)->where('year_id', $year->id)->get();
        }else{
            $mda = Mda::where('email', $user->email)->first();
            return ProcurementPlan::where('business_category_id', $type)->where('year_id', $year->id)->where('mda_id', $mda->id)->get();
        }
    }

    public function getPlansByTypeAndYear($type, $year)
    {
        $user = auth()->user();
        if($user->user_type == "admin"){
            return ProcurementPlan::where('plan_title', $type)->get();
        }else{
            $mda = Mda::where('email', $user->email)->first();
            return ProcurementPlan::where('plan_title', $type)->where('mda_id', $mda->id)->get();
        }
    }

    public function findById($id) {
//        return ProcurementPlan::leftJoin('mda_plan', 'procurement_plans.id', '=', 'mda_plan.plan_id')->where('procurement_plans.id', $id)->first();
        return ProcurementPlan::find($id);
    }

    public function findByMdaId($mda_id) {
        return ProcurementPlan::where('mda_id', $mda_id)->get();
    }

    public function update($request, $id) {
        $plan = $this->findById($id);
        $plan->plan_title = $request->plan_title;
        $plan->project_description = $request->project_description;
        $plan->package_number = $request->package_number;
        $plan->lot_number = $request->lot_number;
        $plan->lumpsum = $request->lumpsum;
        $plan->procurement_method = $request->procurement_method;
        $plan->budgetry_amount = $request->budgetry_amount;
        $plan->pre_post_qualification = $request->pre_post_qualification;
        $plan->approval_threshold = $request->approval_threshold;
        $plan->prep_submissions_by_mda = $request->prep_submissions_by_mda;
        $plan->mda_approval = $request->mda_approval;
        $plan->advertisement_for_pre_qualification = $request->advertisement_for_pre_qualification;
        $plan->bid_invitation_date = $request->bid_invitation_date;
        $plan->bid_closing_date = $request->bid_closing_date;
        $plan->submission_bid_eval_rpt = $request->submission_bid_eval_rpt;
        $plan->mda_approval_2 = $request->mda_approval_2;
        $plan->contract_amount_certified = $request->contract_amount_certified;
        $plan->sec_approval = $request->sec_approval;
        $plan->date_of_contract_offer = $request->date_of_contract_offer;
        $plan->date_of_contract_signature = $request->date_of_contract_signature;
        $plan->mobilization_advance_payment = $request->mobilization_advance_payment;
        $plan->substantial_completion = $request->substantial_completion;
        $plan->final_acceptance = $request->final_acceptance;
        $plan->final_cost = $request->final_cost;
        $plan->action_party = $request->action_party;
        $plan->champion = $request->champion;

        $plan->contract_type = $request->contract_type;
        $plan->contract_amount = $request->contract_amount;
        $plan->selection_method = $request->selection_method;
        $plan->qualification = $request->qualification;
        $plan->review = $request->review;
        $plan->prep_and_submission_by_mda = $request->prep_and_submission_by_mda;
        $plan->advertisement = $request->advertisement;
        $plan->lead_time_before_submission = $request->lead_time_before_submission;
        $plan->closing_date = $request->closing_date;
        $plan->opening_date = $request->opening_date;
        $plan->tech_evaluation_report = $request->tech_evaluation_report;
        $plan->opening_of_fin_proposal = $request->opening_of_fin_proposal;
        $plan->submission_of_evaluation_report_technical_financial = $request->submission_of_evaluation_report_technical_financial;
        $plan->negotiations = $request->negotiations;
        $plan->mda_approval_No_objection_date = $request->mda_approval_No_objection_date;
        $plan->certifiable_amount_per_contract = $request->certifiable_amount_per_contract;
        $plan->submission_of_draft_report = $request->submission_of_draft_report;
        $plan->submission_of_final_report = $request->submission_of_final_report;

        $plan->estimated_amount_in_naira = $request->estimated_amount_in_naira;
        $plan->arrival_of_goods = $request->arrival_of_goods;
        $plan->final_inspection_acceptance = $request->final_inspection_acceptance;
        $plan->save();
        return 1;
    }

    public function approveDeclinePlan($request) {
        $plans = $request->plan_ids;
        foreach($plans as $plan) {
            $planToUpdate = $this->findById($plan);
            $planToUpdate->approval_status = !$planToUpdate->approval_status;
            $planToUpdate->approved_by = auth()->user()->name;
            $planToUpdate->save();

            // Send notification of plan approval to MDA
            $mda = Mda::where('id', $planToUpdate->mda_id)->first();
            if($planToUpdate->approval_status == 1) {
                try{
                    $mda->notify(new SendMdaApprovalNotification($mda, $planToUpdate));
                }catch(\Exception $e){
                    // die slowly
                }
            }else {
                try{
                    $mda->notify(new SendMdaDeclineNotification($mda, $planToUpdate));
                }catch(\Exception $e){
                    // die slowly
                }
            }
        }
        return true;
    }

    public function destroy($id){
        //TODO: make sure only the mda can delete.
        $plan = ProcurementPlan::where('approval_status', false)->where('id', $id)->first();
        if($plan){
            // $plan->destroy(); //not sure this will work
            ProcurementPlan::destroy($id);
            return true;
        }else{
            return false;
        }
    }

}
