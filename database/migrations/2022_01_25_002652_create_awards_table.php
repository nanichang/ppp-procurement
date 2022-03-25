<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('status', ['approved', 'awarded', 'pending', 'accepted', 'cancelled'])->default('pending');
            $table->date('approval_date')->nullable();
            $table->date('acceptance_date')->nullable();
            $table->date('cancellation_date')->nullable();
            $table->date('award_letter_date')->nullable();
            $table->boolean('award_notification_sent')->default(false);
            $table->string('uploaded_approval_file')->nullable();
            $table->string('uploaded_acceptance_file')->nullable();
            // $table->string('uploaded_award_file')->nullable();
            $table->text('approval_comment')->nullable();
            $table->text('acceptance_comment')->nullable();
            $table->text('cancellation_comment')->nullable();
            $table->text('award_letter_comment')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('plan_advert_id');
            $table->unsignedInteger('advert_lot_id');
            $table->foreign('advert_lot_id')->references('id')->on('advert_lots');
            $table->foreign('plan_advert_id')->references('id')->on('plan_adverts');
            $table->unsignedBigInteger('evaluator_admin_id');
            $table->foreign('evaluator_admin_id')->references('id')->on('evaluators');
            $table->unsignedBigInteger('contractor_id');
            $table->unsignedBigInteger('sales_id');
            $table->foreign('contractor_id')->references('id')->on('contractors');
            $table->foreign('sales_id')->references('id')->on('sales');
            $table->unsignedBigInteger('mda_id');
            $table->foreign('mda_id')->references('id')->on('mdas');
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('awards');
    }
}
