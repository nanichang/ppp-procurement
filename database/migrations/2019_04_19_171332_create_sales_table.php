<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('advert_lot_id');
            $table->string('lot_description');
            $table->integer('advert_id');
            $table->string('advert_introduction');
            $table->string('advert_name');
            $table->integer('amount');
            $table->string('payment_status')->nullable();
            $table->string('payment_date')->nullable();
            $table->integer('user_id');
            $table->string('user_name');
            $table->string('mda_id');
            $table->string('mda_name');
            $table->string('transaction_id');
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
        Schema::dropIfExists('sales');
    }
}
