<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReplaceAdvertIdWithPlanAdvertIdAtAdvertLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advert_lots', function (Blueprint $table) {
            $table->dropColumn('advert_id');
            $table->unsignedBigInteger('plan_advert_id');
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
        Schema::table('advert_lots', function($table) {
             $table->integer('advert_id');
             $table->dropColumn('plan_advert_id');
          });
    }
}
