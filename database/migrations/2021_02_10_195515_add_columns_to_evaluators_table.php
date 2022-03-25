<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToEvaluatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluators', function (Blueprint $table) {
            $table->unsignedInteger('advert_lot_id')->nullable();
            $table->foreign('advert_lot_id')->references('id')->on('advert_lots');

            $table->unsignedBigInteger('plan_advert_id')->nullable();
            $table->foreign('plan_advert_id')->references('id')->on('plan_adverts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluators', function (Blueprint $table) {
            $table->dropColumn('advert_lot_id');
            $table->dropColumn('plan_advert_id');
        });
    }
}
