<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            // $table->integer('mda_id')->unsigned()->nullable();
            // $table->foreign('mda_id')->references('id')->on('mdas');
            $table->bigInteger('mda_id')->unsigned()->nullable();
            //$table->foreign('mda_id')->references('id')->on('mdas');

            // $table->unsignedBigInteger('mda_id')->nullable();
            // $table->foreign('mda_id')->references('id')->on('mdas');
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
        Schema::dropIfExists('qualifications');
    }
}
