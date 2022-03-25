<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractorAdvertCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractor_advert_criterias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('passed')->default(false);
            $table->unsignedBigInteger('plan_advert_id')->nullable();
            $table->foreign('plan_advert_id')->references('id')->on('plan_adverts');
            $table->unsignedBigInteger('advert_criteria_id')->nullable();
            $table->foreign('advert_criteria_id')->references('id')->on('advert_criterias');

            $table->unsignedBigInteger('contractor_id');
            $table->foreign('contractor_id')->references('id')->on('contractors');

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
        Schema::dropIfExists('contractor_advert_criterias');
    }
}
