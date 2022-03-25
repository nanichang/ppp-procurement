<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeBidOpeningAndClosingToDatetimeInSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('payment_type');
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->dateTime('bid_opening_date')->change();
            $table->dateTime('closing_date')->change();
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->enum('payment_type', ['cash','online'])->default('cash');
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
            $table->date('bid_opening_date')->change();
            $table->date('closing_date')->change();
        });
    }
}
