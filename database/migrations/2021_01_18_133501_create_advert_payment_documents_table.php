<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertPaymentDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert_payment_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('document')->nullable();

            $table->unsignedBigInteger('advert_payment_id')->nullable();
            $table->foreign('advert_payment_id')->references('id')->on('advert_payments');

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
        Schema::dropIfExists('advert_payment_documents');
    }
}
