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
                        <input type="hidden" name="plan_title" value="works">
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
                                        <label for="lumpsum">Lumpsum or Bill of Quantities:</label>
                                        <input type="number" name="lumpsum" value="{{ $plan->lumpsum }}" class="form-control" id="lumpsum">
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
                                        <label for="budgetry_amount">Budgetary Amount in Naira:</label>
                                        <input type="number" name="budgetry_amount" value="{{ $plan->budgetry_amount }}" class="form-control" id="budgetry_amount">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="pre_post_qualification">Pre or Post Qualification:</label>
                                        <input type="date" name="pre_post_qualification" value="{{ $plan->pre_post_qualification }}" class="form-control" id="pre_post_qualification">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="approval_threshold">Approval Thresholds:</label>
                                        <input type="text" name="approval_threshold" value="{{ $plan->approval_threshold }}" class="form-control" id="approval_threshold">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="prep_submissions_by_mda">Prep &amp; Submission by MDAs:</label>
                                        <input type="date" name="prep_submissions_by_mda" value="{{ $plan->prep_submissions_by_mda }}" class="form-control" id="prep_submissions_by_mda">
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
                                        <label for="advertisement_for_pre_qualification">Advertisement for Pre-Qualification:</label>
                                        <input type="date" name="advertisement_for_pre_qualification" value="{{ $plan->advertisement_for_pre_qualification }}" class="form-control" id="advertisement_for_pre_qualification">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="bid_invitation_date">Bid Invitation Date:</label>
                                        <input type="date" name="bid_invitation_date" value="{{ $plan->bid_invitation_date }}" class="form-control" id="bid_invitation_date">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="bid_closing_date">Bid Closing-Opening:</label>
                                        <input type="date" name="bid_closing_date" value="{{ $plan->bid_closing_date }}" class="form-control" id="bid_closing_date">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="submission_bid_eval_rpt">Submission Bid Eval Rpt:</label>
                                        <input type="date" name="submission_bid_eval_rpt" value="{{ $plan->submission_bid_eval_rpt }}" class="form-control" id="submission_bid_eval_rpt">
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
                                        <label for="contract_amount_certified">Contract Amount Certified in Naira:</label>
                                        <input type="number" name="contract_amount_certified" value="{{ $plan->contract_amount_certified }}" class="form-control" id="contract_amount_certified">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="sec_approval">SEC Approval:</label>
                                        <input type="date" name="sec_approval" value="{{$plan->sec_approval}}" class="form-control" id="sec_approval">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="date_of_contract_offer">Date of contract offer:</label>
                                        <input type="date" name="date_of_contract_offer" value="{{ $plan->date_of_contract_offer }}" class="form-control" id="date_of_contract_offer">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="date_of_contract_signature">Date Contract Signature:</label>
                                        <input type="date" name="date_of_contract_signature" value="{{ $plan->date_of_contract_signature }}" class="form-control" id="date_of_contract_signature">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="mobilization_advance_payment">Mobilization Advance Payment:</label>
                                        <input type="text" name="mobilization_advance_payment" value="{{ $plan->mobilization_advance_payment }}" class="form-control" id="mobilization_advance_payment">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="substantial_completion">Substantial Completion:</label>
                                        <input type="text" name="substantial_completion" value="{{ $plan->substantial_completion }}" class="form-control" id="substantial_completion">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="final_acceptance">Final Acceptance:</label>
                                        <input type="text" name="final_acceptance" value="{{ $plan->final_acceptance }}" class="form-control" id="final_acceptance">
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
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="champion">Champion:</label>
                                        <input type="text" name="champion" value="{{ $plan->champion }}" class="form-control" id="champion">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary btn-lg pull-right">Update Record</button>
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





