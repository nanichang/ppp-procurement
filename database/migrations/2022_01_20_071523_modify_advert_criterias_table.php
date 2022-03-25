<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAdvertCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advert_criterias', function (Blueprint $table) {
            $table->enum('value_type', ['binary', 'numeric'])->default('binary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advert_criterias', function (Blueprint $table) {
            $table->dropColumn('value_type');
        });
    }
}
