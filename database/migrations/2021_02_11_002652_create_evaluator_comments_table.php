<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluatorCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluator_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('evaluator_name');
            $table->unsignedInteger('advert_lot_id');
            $table->foreign('advert_lot_id')->references('id')->on('advert_lots');
            $table->text('comment');
            $table->unsignedBigInteger('evaluator_id');
            $table->foreign('evaluator_id')->references('id')->on('evaluators');
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
        Schema::dropIfExists('evaluator_comments');
    }
}
