<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePotentialUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potential_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fbid', 255)->nullable();
            $table->string('google_id', 255);
            $table->string('email', 255)->nullable()->index('email');
            $table->string('firstname', 255)->nullable();
            $table->string('lastname', 255)->nullable();
            $table->string('job_title', 255);
            $table->string('business_type', 255);
            $table->string('company', 255);
            $table->string('address', 255)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('mobile', 50)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('zipcode', 50)->nullable();
            $table->string('description', 255);
            $table->string('country', 255)->nullable();
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
            $table->string('ip_addr', 50);
            $table->string('user_id', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('potential_users');
    }
}
