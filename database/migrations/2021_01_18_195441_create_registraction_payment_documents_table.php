<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistractionPaymentDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registraction_payment_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('document')->nullable();

            $table->unsignedBigInteger('registration_payment_id')->nullable();
            $table->foreign('registration_payment_id')->references('id')->on('registration_payments');

            $table->unsignedBigInteger('contractor_id')->nullable();
            $table->foreign('contractor_id')->references('id')->on('contractors');
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
        Schema::dropIfExists('registraction_payment_documents');
    }
}
