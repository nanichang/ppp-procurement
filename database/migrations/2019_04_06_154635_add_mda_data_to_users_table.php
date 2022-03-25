<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMdaDataToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_pic')->nullable();
            $table->string('mda_code')->nullable();
            $table->string('mda_short_code')->nullable();
            $table->string('website')->nullable();
            $table->string('mandate')->nullable();
            $table->integer('sub_sector_id')->unsigned()->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->decimal('split_percentage', 5, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_pic');
            $table->dropColumn('mda_code');
            $table->dropColumn('mda_short_code');
            $table->dropColumn('website');
            $table->dropColumn('mandate');
            $table->dropColumn('sub_sector_id');
            $table->dropColumn('bank_name');
            $table->dropColumn('bank_code');
            $table->dropColumn('bank_account_no');
            $table->dropColumn('split_percentage');
        });
    }
}
