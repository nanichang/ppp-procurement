<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdvertModeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('advert_modes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('advert_type_name');
            $table->integer('advert_type_id')->unsigned()->nullable();
            $table->foreign('advert_type_id')->references('id')->on('advert_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        dropIfExists('advert_modes');
    }
}
