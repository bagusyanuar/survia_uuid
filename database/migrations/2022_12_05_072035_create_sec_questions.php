<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sec_questions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sec_id');
            $table->text('question');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('sec_id')->references('id')->on('secs');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sec_questions');
    }
}
