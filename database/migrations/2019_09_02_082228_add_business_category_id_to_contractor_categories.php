<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBusinessCategoryIdToContractorCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contractor_categories', function (Blueprint $table) {
            $table->integer('business_category_id')->unsigned()->nullable();
            $table->foreign('business_category_id')->references('id')->on('business_categories')->onDelete('cascade');
            $table->string('business_sub_category_1')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contractor_categories', function (Blueprint $table) {
            $table->dropColumn('business_category_id');
            $table->dropColumn('business_sub_category_1');
        });
    }
}
