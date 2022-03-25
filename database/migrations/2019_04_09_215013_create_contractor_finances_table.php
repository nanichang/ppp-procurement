<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractorFinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractor_finances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('year');
            $table->string('turn_over');
            $table->string('total_asset');
            $table->string('total_liability');
            $table->string('witholding_tax');
            $table->string('tax_paid');
            $table->string('tcc_no');
            $table->string('audit_firm');
            $table->string('report_date');
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
        Schema::dropIfExists('contractor_finances');
    }
}
