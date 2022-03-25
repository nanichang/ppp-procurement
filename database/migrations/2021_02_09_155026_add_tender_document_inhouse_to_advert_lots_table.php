<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTenderDocumentInhouseToAdvertLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advert_lots', function (Blueprint $table) {
            $table->string('tender_document_inhouse')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advert_lots', function (Blueprint $table) {
            $table->dropColumn('tender_document_inhouse');
        });
    }
}
