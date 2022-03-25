<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeBidOpeningAndClosingToDatetimeInPlanAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_adverts', function (Blueprint $table) {
            $table->dateTime('bid_opening_date')->change();
            $table->dateTime('closing_date')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_adverts', function (Blueprint $table) {
            $table->date('bid_opening_date')->change();
            $table->date('closing_date')->change();
        });
    }
}
