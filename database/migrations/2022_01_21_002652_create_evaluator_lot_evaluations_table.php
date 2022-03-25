<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluatorLotEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluator_lot_evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('evaluator_name');
            $table->unsignedInteger('advert_lot_id');
            $table->foreign('advert_lot_id')->references('id')->on('advert_lots');
            $table->string('type');
            $table->boolean('binary_value')->nullable();
            $table->integer('numeric_value')->nullable();
            $table->unsignedBigInteger('evaluator_id');
            $table->foreign('evaluator_id')->references('id')->on('evaluators');
            $table->unsignedBigInteger('advert_criteria_id')->nullable();
            $table->foreign('advert_criteria_id')->references('id')->on('advert_criterias');
            $table->unsignedBigInteger('contractor_id');
            $table->unsignedBigInteger('sale_id');
            $table->foreign('contractor_id')->references('id')->on('contractors');
            $table->foreign('sale_id')->references('id')->on('sales');
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
        Schema::dropIfExists('evaluator_lot_evaluations');
    }
}
