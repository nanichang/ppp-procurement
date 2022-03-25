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
                        {{ strtoupper($plan)  }}
                    </header>

                    <form method="POST" action="{{ route('procurementPlan.create') }}">
                        @csrf
                        <input type="hidden" name="plan_title" value="goods">
                        <input type="hidden" name="business_category_id" value="{{ $category->id }}">
                        <input type="hidden" name="year_id" value="{{ $year->id }}">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="project_description">Project Description:</label>
                                        <input type="text" name="project_description" class="form-control" id="project_description">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="package_number">Package Number:</label>
                                        <input type="text" name="package_number" class="form-control" id="package_number">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="lot_number">Lot Number:</label>
                                        <input type="text" name="lot_number" class="form-control" id="lot_number">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="budgetry_amount">Budgetary Amount in Naira:</label>
                                        <input type="text" name="budgetry_amount" class="form-control" id="budgetry_amount">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="estimated_amount_in_naira">Estimated Amount in Naira:</label>
                                        <input type="number" name="estimated_amount_in_naira" class="form-control" id="estimated_amount_in_naira">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="procurement_method">Procurement Method:</label>
                                        <input type="text" name="procurement_method" class="form-control" id="procurement_method">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="pre_post_qualification">Pre-qualification Date:</label>
                                        <input type="date" name="pre_post_qualification" class="form-control" id="pre_post_qualification">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="approval_threshold">Approval Thresholds :</label>
                                        <input type="text" name="approval_threshold" class="form-control" id="approval_threshold">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="prep_submissions_by_mda">Prep &amp; Submission by MDAs:</label>
                                        <input type="date" name="prep_submissions_by_mda" class="form-control" id="prep_submissions_by_mda">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="mda_approval">MDA Approval:</label>
                                        <input type="date" name="mda_approval" class="form-control" id="mda_approval">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="advertisement_for_pre_qualification">Advertisement for Pre-Qualification:</label>
                                        <input type="text" name="advertisement_for_pre_qualification" class="form-control" id="advertisement_for_pre_qualification">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="bid_invitation_date">Bid Invitation Date:</label>
                                        <input type="date" name="bid_invitation_date" class="form-control" id="bid_invitation_date">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="bid_closing_date">Bid Closing-Opening:</label>
                                        <input type="date" name="bid_closing_date" class="form-control" id="bid_closing_date">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="mda_approval_No_objection_date">MDA Approval/BPP "No Objection":</label>
                                        <input type="text" name="mda_approval_No_objection_date" class="form-control" id="mda_approval_No_objection_date">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="certifiable_amount_per_contract">Certifiable Amount per Contract:</label>
                                        <input type="number" name="certifiable_amount_per_contract" class="form-control" id="certifiable_amount_per_contract">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="sec_approval">SEC Approval:</label>
                                        <input type="text" name="sec_approval" class="form-control" id="sec_approval">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="date_of_contract_offer">Date of contract offer:</label>
                                        <input type="date" name="date_of_contract_offer" class="form-control" id="date_of_contract_offer">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="date_of_contract_signature">Date Contract Signature:</label>
                                        <input type="date" name="date_of_contract_signature" class="form-control" id="date_of_contract_signature">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="mobilization_advance_payment">Mobilization Advance Payment:</label>
                                        <input type="text" name="mobilization_advance_payment" class="form-control" id="mobilization_advance_payment">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="arrival_of_goods">Arrival of Goods:</label>
                                        <input type="date" name="arrival_of_goods" class="form-control" id="arrival_of_goods">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="final_inspection_acceptance">Inspection Final Acceptance:</label>
                                        <input type="date" name="final_inspection_acceptance" class="form-control" id="final_inspection_acceptance">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="action_party">Action Party:</label>
                                        <input type="text" name="action_party" class="form-control" id="action_party">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="champion">Champion:</label>
                                        <input type="text" name="champion" class="form-control" id="champion">
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





