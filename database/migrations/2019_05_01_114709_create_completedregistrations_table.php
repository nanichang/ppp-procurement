<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompletedregistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('completed_registrations', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('company_name');
            $table->string('registration_category');
            $table->string('category_id');
            $table->string('description');
            $table->string('expiration_date');
            $table->string('renewal_amount');
            $table->string('registration_id');
            $table->string('amount');
            $table->integer('user_id');
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
        Schema::dropIfExists('completed_registrations');
    }
}
