<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plan_title');
            $table->boolean('is_approve')->default(false);
            // Works
            $table->longText('project_description')->nullable();
            $table->string('package_number')->nullable();
            $table->string('lot_number')->nullable();
            $table->string('lumpsum')->nullable();
            $table->string('procurement_method')->nullable();
            $table->bigInteger('budgetry_amount')->nullable();
            $table->string('pre_post_qualification')->nullable();
            $table->string('approval_threshold')->nullable();
            $table->string('prep_submissions_by_mda')->nullable();
            $table->string('mda_approval')->nullable();
            $table->string('advertisement_for_pre_qualification')->nullable();
            $table->date('bid_invitation_date')->nullable();
            $table->date('bid_closing_date')->nullable();
            $table->string('submission_bid_eval_rpt')->nullable();
            $table->string('mda_approval_2')->nullable();
            $table->date('mda_approval_3')->nullable();
            $table->bigInteger('contract_amount_certified')->nullable();
            $table->string('sec_approval')->nullable();
            $table->date('date_of_contract_offer')->nullable();
            $table->date('date_of_contract_signature')->nullable();
            $table->string('mobilization_advance_payment')->nullable();
            $table->string('substantial_completion')->nullable();
            $table->string('final_acceptance')->nullable();
            $table->string('final_cost')->nullable();
            $table->string('action_party');
            $table->string('champion');
            // Consultation
            $table->string('contract_type')->nullable();
            $table->bigInteger('contract_amount')->nullable();
            $table->string('selection_method')->nullable();
            $table->string('qualification')->nullable();
            $table->string('review')->nullable();
            $table->string('prep_and_submission_by_mda')->nullable();
            $table->string('advertisement')->nullable();
            $table->string('lead_time_before_submission')->nullable();
            $table->date('submission_date')->nullable();
            $table->date('closing_date')->nullable();
            $table->date('opening_date')->nullable();
            $table->date('proposal_invitation_submission_date')->nullable();
            $table->date('tech_evaluation_report')->nullable();
            $table->string('opening_of_fin_proposal')->nullable();
            $table->string('submission_of_evaluation_technical_report')->nullable();
            $table->string('submission_of_evaluation_report_technical_financial')->nullable();
            $table->string('negotiations')->nullable();
            $table->string('mda_approval_No_objection_date')->nullable();
            $table->bigInteger('certifiable_amount_per_contract')->nullable();
            $table->date('submission_of_draft_report')->nullable();
            $table->date('submission_of_final_report')->nullable();

            // Goods
            $table->bigInteger('estimated_amount_in_naira')->nullable();
            $table->date('arrival_of_goods')->nullable();
            $table->date('final_inspection_acceptance')->nullable();

            $table->bigInteger('mda_id')->unsigned();
            $table->foreign('mda_id')->references('id')->on('mdas');
            $table->integer('business_category_id')->unsigned();
            $table->foreign('business_category_id')->references('id')->on('business_categories');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procurement_plans');
    }
}
