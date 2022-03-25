<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompliancesTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compliances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->string('parent_company');
            $table->string('cac_date_of_reg');
            $table->string('cac_number');
            $table->string('tcc_no');
            $table->string('tcc_tin_no');
            $table->string('tcc_ownership_structure');
            $table->string('tcc_company_ownership');
            $table->string('pension_employer_code');
            $table->string('pension_certificate_number');
            $table->string('pension_expiring_date');
            $table->string('pension_no_of_employee');
            $table->string('itf_registration_no');
            $table->string('itf_certificate_no');
            $table->string('itf_payment_date');
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
        Schema::dropIfExists('compliances');
    }
}
