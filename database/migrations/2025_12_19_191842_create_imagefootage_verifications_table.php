<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_verifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('User ID');
            $table->string('otp_type', 32)->nullable()->comment('OTP Type');
            $table->string('one_time_password', 32)->nullable()->comment('One Time Password');
            $table->string('otp_token', 255)->nullable()->comment('OTP Token');
            $table->dateTime('token_valid_date')->nullable()->comment('Token Valid Date');
            $table->integer('max_otp_attempts')->default(0)->comment('Max OTP Attempts');
            $table->integer('unsuccessful_verification_attempts')->default(0)->comment('Maximum Unsuccessful Verification Attempts');
            $table->dateTime('last_failed_attempt_at')->nullable()->comment('Last Failed Attempt At');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('imagefootage_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * 
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_verifications');
    }
};