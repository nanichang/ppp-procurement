<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanAdvertDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_advert_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('document_title')->nullable();
            $table->string('document_url');
            $table->unsignedBigInteger('advert_id')->nullable();
            $table->foreign('advert_id')->references('id')->on('plan_adverts');
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
        Schema::dropIfExists('plan_advert_documents');
    }
}
