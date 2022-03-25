<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractorMachineriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('contractor_machineries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('equipment_type');
            $table->string('specifics');
            $table->string('acquisition_date');
            $table->string('cost');
            $table->string('location');
            $table->string('serial_no');
            $table->string('equipment_status');
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
        Schema::dropIfExists('contractor_machineries');
    }
}
