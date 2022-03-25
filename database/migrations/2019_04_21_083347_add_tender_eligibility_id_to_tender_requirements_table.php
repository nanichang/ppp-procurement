<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTenderEligibilityIdToTenderRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tender_requirements', function (Blueprint $table) {
            $table->integer('tender_eligibility_id')->unsigned();
            // $table->foreign('tender_eligibility_id')->references('id')->on('tender_eligibilities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tender_requirements', function (Blueprint $table) {
            $table->dropColumn('tender_eligibility_id');
        });
    }
}
