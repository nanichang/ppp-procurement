<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenderRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_requirements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('lot_id')->unsigned();
           // $table->foreign('lot_id')->references('id')->on('advert_lots');
            $table->string('lot_no');
          //  $table->foreign('lot_no')->references('lot_no')->on('advert_lots');
            $table->integer('advert_id');
           // $table->foreign('advert_id')->references('id')->on('adverts');
            $table->string('project_name');
          //  $table->foreign('project_name')->references('project_name')->on('advert_lots');
           //  $table->integer('tender_eligibility_id');
          //  $table->foreign('tender_eligibility_id')->references('tender_eligibility_id')->on('tender_eligibilities');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tender_requirements');
    }
}
