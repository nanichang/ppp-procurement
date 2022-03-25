<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMdasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mdas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('profile_pic')->nullable();
            $table->string('mda_code');
            $table->string('mda_shortcode');
            $table->string('subsector');
            $table->string('address');
            $table->string('email');
            $table->string('password');
            $table->string('mandate');
            $table->string('bank_name');
            $table->string('bank_account');
            $table->string('split_percentage');
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
        Schema::dropIfExists('mdas');
    }
}
