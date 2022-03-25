<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_adverts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('budget_year')->nullable();
            $table->string('advert_type')->nullable();
            $table->text('advert_plan_desc')->nullable();
            $table->string('introduction')->nullable();
            $table->date('advert_publish_date')->nullable();
            $table->date('bid_opening_date');
            $table->date('closing_date');
            $table->text('tender_collection')->nullable();
            $table->text('tender_submission')->nullable();
            $table->text('tender_opening')->nullable();
            $table->boolean('approval_status')->default(false);

            $table->unsignedBigInteger('mda_id')->nullable();
            $table->foreign('mda_id')->references('id')->on('mdas');

            $table->unsignedBigInteger('procurement_plan_id')->nullable();
            $table->foreign('procurement_plan_id')->references('id')->on('procurement_plans');

             $table->bigInteger('year_id')->unsigned()->nullable();
             $table->foreign('year_id')->references('id')->on('procurement_years');
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
        Schema::dropIfExists('plan_adverts');
    }
}
