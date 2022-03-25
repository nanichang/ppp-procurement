<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdvertTypeIdAndAdvertModeIdToPlanAdvertsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('plan_adverts', function (Blueprint $table) {
            // $table->string('advert_type');
            $table->string('advert_mode');
            $table->integer('advert_type_id')->unsigned()->nullable();
            $table->integer('advert_mode_id')->unsigned()->nullable();
            $table->foreign('advert_type_id')->references('id')->on('advert_types')->onDelete('cascade');
            $table->foreign('advert_mode_id')->references('id')->on('advert_modes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('plan_adverts', function (Blueprint $table) {
            // $table->dropColumn('advert_type');
            $table->dropColumn('advert_mode');
            $table->dropColumn('advert_type_id');
            $table->dropColumn('advert_mode_id');
        });
    }
}

