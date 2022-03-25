<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdvertTypeIdAndAdvertModeIdToAdvertsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('adverts', function (Blueprint $table) {
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
        Schema::table('adverts', function (Blueprint $table) {
            $table->dropColumn('advert_type_id');
            $table->dropColumn('advert_mode_id');
        });
    }
}
