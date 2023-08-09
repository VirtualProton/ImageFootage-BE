<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 100)->nullable();
            $table->string('last_name')->nullable();
            $table->string('title', 100)->nullable();
            $table->string('user_name', 200)->nullable();
            $table->string('contact_owner', 100)->nullable();
            $table->integer('account_manager_id')->nullable();
            $table->string('mobile', 100)->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('company', 300)->nullable();
            $table->string('occupation', 300)->nullable();
            $table->string('email')->unique();
            $table->integer('extension')->nullable();
            $table->string('password');
            $table->text('remember_token')->nullable();
            $table->text('address')->nullable();
            $table->integer('city')->nullable();
            $table->integer('state')->nullable();
            $table->integer('country')->nullable();
            $table->bigInteger('postal_code')->nullable();
            $table->enum('type', ['L', 'U', 'C'])->nullable()->comment('(L=>Leads,U=>User,C=>Contact)');
            $table->enum('status', ['1', '0'])->nullable()->default('1');
            $table->text('description')->nullable();
            $table->text('gmail_idtoken')->nullable();
            $table->text('profile_photo')->nullable();
            $table->string('provider', 100)->nullable();
            $table->text('fb_token')->nullable();
            $table->text('notes')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('otp', 225)->nullable();
            $table->string('gst')->nullable();
            $table->string('pan')->nullable();
            $table->text('address2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_users');
    }
}
