<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyEvaluatorLotEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluator_lot_evaluations', function (Blueprint $table) {
            $table->string('advert_criteria_title')->nullable();
            $table->string('advert_criteria_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluator_lot_evaluations', function (Blueprint $table) {
            $table->dropColumn('advert_criteria_title');
            $table->dropColumn('advert_criteria_description');
        });
    }
}
