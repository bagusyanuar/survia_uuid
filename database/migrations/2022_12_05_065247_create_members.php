<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->unique();
            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('job_id')->unsigned();
            $table->foreignUuid('sec_id');
            $table->bigInteger('bank_id')->unsigned();
            $table->string('identifier', 25);
            $table->string('name');
            $table->enum('gender', ['men', 'women']);
            $table->text('address');
            $table->date('date_of_birth');
            $table->string('qualification');
            $table->boolean('is_identifier_valid')->default(false);
            $table->boolean('is_active')->default(false);
            $table->boolean('is_suspend')->default(false);
            $table->integer('point')->default(0)->unsigned();
            $table->string('account_number');
            $table->string('account_holder');
            $table->string('phone_model');
            $table->string('device_token')->nullable();
            $table->string('otp_code')->nullable();
            $table->timestamp('otp_expired_at')->nullable();
            $table->timestamp('last_active')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->foreign('sec_id')->references('id')->on('secs');
            $table->foreign('bank_id')->references('id')->on('banks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
