<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToProcurementPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('procurement_plans', function (Blueprint $table) {
            $table->unsignedBigInteger('year_id');
            $table->foreign('year_id')->references('id')->on('procurement_years');

            $table->boolean('submitted')->default(false);
            $table->boolean('approval_status')->default(false);
            $table->string('approved_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('procurement_plans', function (Blueprint $table) {
            $table->dropColumn('year_id');

            $table->dropColumn('submitted');
            $table->dropColumn('approval_status');
            $table->dropColumn('approved_by');
        });
    }
}
