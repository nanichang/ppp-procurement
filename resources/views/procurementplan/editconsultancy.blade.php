@extends('layouts.mda')
@section('procurement-plan')
    active
@endsection

@section('content')
    <section class="hbox stretch">
        <section class="vbox">
            <section class="scrollable padder">
                <br/>
                <section class="panel panel-info">
                    <header class="panel-heading">
                        {{ strtoupper($plan->project_description)  }}
                    </header>

                    <form method="POST" action="{{ route('procurementPlan.update', $plan->id) }}">
                        @csrf
                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="plan_title" value="consultancy">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="project_description">Project Description:</label>
                                        <input type="text" name="project_description" value="{{ $plan->project_description }}" class="form-control" id="project_description">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="package_number">Package Number:</label>
                                        <input type="text" name="package_number" value="{{ $plan->package_number }}" class="form-control" id="package_number">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="lot_number">Lot Number:</label>
                                        <input type="text" name="lot_number" value="{{ $plan->lot_number }}" class="form-control" id="lot_number">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="contract_type">Contract type:</label>
                                        <input type="text" name="contract_type" value="{{ $plan->contract_type }}" class="form-control" id="contract_type">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="contract_amount">Contract Amount:</label>
                                        <input type="number" name="contract_amount" value="{{ $plan->contract_amount }}" class="form-control" id="v">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="procurement_method">Procurement Method:</label>
                                        <input type="text" name="procurement_method" value="{{ $plan->procurement_method }}" class="form-control" id="procurement_method">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="approval_threshold">Approval Thresholds :</label>
                                        <input type="text" name="approval_threshold" value="{{ $plan->approval_threshold }}" class="form-control" id="approval_threshold">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="selection_method">Selection Method:</label>
                                        <input type="text" name="selection_method" value="{{ $plan->selection_method }}" class="form-control" id="selection_method">
                                    </div>
                                    <div class="form-group">
                                        <label for="budgetry_amount">Budgetary Amount in Naira:</label>
                                        <input type="number" name="budgetry_amount" value="{{ $plan->budgetry_amount }}" class="form-control" id="budgetry_amount">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="qualification">Qualification:</label>
                                        <input type="text" name="qualification" value="{{ $plan->qualification }}" class="form-control" id="qualification">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="review">Review:</label>
                                        <input type="text" name="review" value="{{ $plan->review }}" class="form-control" id="review">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="prep_submissions_by_mda">Prep &amp; Submission by MDAs:</label>
                                        <input type="text" name="prep_submissions_by_mda" value="{{ $plan->prep_submissions_by_mda }}" class="form-control" id="prep_submissions_by_mda">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="mda_approval">MDA Approval:</label>
                                        <input type="date" name="mda_approval" value="{{ $plan->mda_approval }}" class="form-control" id="mda_approval">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="advertisement_for_pre_qualification">Advertisement:</label>
                                        <input type="date" name="advertisement_for_pre_qualification" value="{{ $plan->advertisement_for_pre_qualification }}" class="form-control" id="advertisement_for_pre_qualification">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lead_time_before_submission">Lead-Time Before Shortlist:</label>
                                        <input type="date" name="lead_time_before_submission" value="{{ $plan->lead_time_before_submission }}" class="form-control" id="lead_time_before_submission">
                                    </div>
                                </div><div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="submission_date">Submission Date:</label>
                                        <input type="date" name="submission_date" value="{{ $plan->submission_date }}" class="form-control" id="submission_date">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="mda_approval_2">MDA Approval:</label>
                                        <input type="date" name="mda_approval_2" value="{{ $plan->mda_approval_2 }}" class="form-control" id="mda_approval_2">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="opening_date">Opening Date:</label>
                                        <input type="date" name="opening_date" value="{{ $plan->opening_date }}" class="form-control" id="opening_date">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="closing_date">Closing Date:</label>
                                        <input type="date" name="closing_date" value="{{ $plan->closing_date }}" class="form-control" id="closing_date">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="submission_of_evaluation_technical_report">Submission of Technical Evaluation Report:</label>
                                        <input type="date" name="submission_of_evaluation_technical_report" value="{{ $plan->submission_of_evaluation_technical_report }}" class="form-control" id="submission_of_evaluation_technical_report">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="mda_approval_3">MDA Approval:</label>
                                        <input type="date" name="mda_approval_3" class="form-control" value="{{ $plan->mda_approval_3 }}" id="mda_approval_3">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="opening_of_fin_proposal">Opening of Financial Proposal:</label>
                                        <input type="date" name="opening_of_fin_proposal" value="{{ $plan->opening_of_fin_proposal }}" class="form-control" id="opening_of_fin_proposal">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="submission_of_evaluation_report_technical_financial">Submission of Evaluation Report - Technical/Financial</label>
                                        <input type="date" name="submission_of_evaluation_report_technical_financial" value="{{ $plan->submission_of_evaluation_report_technical_financial }}" class="form-control" id="submission_of_evaluation_report_technical_financial">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="negotiations">Negotiations:</label>
                                        <input type="date" name="negotiations" value="{{ $plan->negotiations }}" class="form-control" id="negotiations">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="mda_approval_No_objection_date">MDA Approval/ No Objection Date:</label>
                                        <input type="date" name="mda_approval_No_objection_date" value="{{ $plan->mda_approval_No_objection_date }}" class="form-control" id="mda_approval_No_objection_date">
                                    </div>
                                </div><div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="certifiable_amount_per_contract">Certifiable Amount per Contract:</label>
                                        <input type="number" name="certifiable_amount_per_contract" value="{{ $plan->certifiable_amount_per_contract }}" class="form-control" id="certifiable_amount_per_contract">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="sec_approval">SEC Approval:</label>
                                        <input type="date" name="sec_approval" value="{{ $plan->sec_approval }}" class="form-control" id="sec_approval">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="date_of_contract_offer">Date of Contract Offer:</label>
                                        <input type="date" name="date_of_contract_offer" value="{{ $plan->date_of_contract_offer }}" class="form-control" id="date_of_contract_offer">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="date_of_contract_signature">Date of Contract Signature:</label>
                                        <input type="date" name="date_of_contract_signature" value="{{ $plan->date_of_contract_signature }}" class="form-control" id="date_of_contract_signature">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="mobilization_advance_payment">Mobilization/Advance Payment:</label>
                                        <input type="date" name="mobilization_advance_payment" value="{{ $plan->mobilization_advance_payment }}" class="form-control" id="mobilization_advance_payment">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="submission_of_draft_report">Submission of Draft Report:</label>
                                        <input type="date" name="submission_of_draft_report" value="{{ $plan->submission_of_draft_report }}" class="form-control" id="submission_of_draft_report">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="submission_of_final_report">Submission of Final Report:</label>
                                        <input type="date" name="submission_of_final_report" value="{{ $plan->submission_of_final_report }}" class="form-control" id="submission_of_final_report">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="final_cost">Final Cost:</label>
                                        <input type="text" name="final_cost" value="{{ $plan->final_cost }}" class="form-control" id="final_cost">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="action_party">Action Party:</label>
                                        <input type="text" name="action_party" value="{{ $plan->action_party }}" class="form-control" id="action_party">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="champion">Champion:</label>
                                        <input type="text" name="champion" value="{{ $plan->champion }}" class="form-control" id="champion">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary btn-lg pull-right">Save Record</button>
                                </div>
                            </div>
                            <br />
                        </div>
                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection