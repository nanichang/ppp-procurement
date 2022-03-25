<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractorPersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractor_personnels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('nationality');
            $table->string('passport_no');
            $table->string('national_id_no');
            $table->string('employment_type');
            $table->string('experience_years');
            $table->string('joining_date');
            $table->string('school_name');
            $table->string('qualification');
            $table->string('country');
            $table->string('graduation_year');
            $table->string('regulatory_body');
            $table->string('membership_id_no');
            $table->string('project_involved');
            $table->string('description');
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
        Schema::dropIfExists('contractor_personnels');
    }
}
