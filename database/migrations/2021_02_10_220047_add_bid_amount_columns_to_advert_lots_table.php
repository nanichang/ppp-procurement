<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBidAmountColumnsToAdvertLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advert_lots', function (Blueprint $table) {
            $table->decimal('inhouse_bid_amount', 9, 2)->default(0);
            $table->decimal('contractor_bid_amount', 9, 2)->default(0);
            $table->decimal('variation')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advert_lots', function (Blueprint $table) {
            $table->dropColumn('inhouse_bid_amount');
            $table->dropColumn('contractor_bid_amount');
            $table->dropColumn('variation');
        });
    }
}
