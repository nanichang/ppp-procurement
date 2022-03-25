<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractorFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractor_files', function (Blueprint $table) {
            // $table->enum('name', array('cac', 'tcc', 'tin','pencom','itf','audited account', 'swon affidavit', 'placcima'));//Unique per Contractor
            $table->string('name')->nullable();
            $table->string('key')->nullable();
            $table->string('size')->nullable();
            $table->string('mime_type')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigIncrements('id');
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
        Schema::dropIfExists('contractor_files');
    }
}
