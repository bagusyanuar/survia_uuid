<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sec_answers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sec_question_id');
            $table->text('answer');
            $table->integer('score')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('sec_question_id')->references('id')->on('sec_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sec_answers');
    }
}
