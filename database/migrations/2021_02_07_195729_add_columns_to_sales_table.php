<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->unsignedBigInteger('contractor_id')->nullable();
            $table->string('contractor_name')->nullable();
            $table->longText('report')->nullable();
            $table->string('reported_by')->nullable();
            $table->boolean('passed_evaluation')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('contractor_id');
            $table->dropColumn('contractor_name');
            $table->dropColumn('report');
            $table->dropColumn('reported_by');
            $table->dropColumn('passed_evaluation');
        });
    }
}
