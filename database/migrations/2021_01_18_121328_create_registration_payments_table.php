<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('payment_type', ['cash', 'online'])->default('cash');
            $table->enum('status', ['verified', 'pending'])->default('pending');

            $table->unsignedBigInteger('contractor_id')->nullable();
            $table->foreign('contractor_id')->references('id')->on('contractors');

            $table->decimal('amount', 9, 2);
            $table->string('approved_by')->nullable();
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
        Schema::dropIfExists('registration_payments');
    }
}
