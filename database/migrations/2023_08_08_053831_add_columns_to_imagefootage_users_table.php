<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToImagefootageUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_users', function (Blueprint $table) {
            $table->string('email_verify_token', 255)->nullable();
            $table->dateTime('token_valid_date')->nullable();
            $table->dateTime('otp_valid_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagefootage_users', function (Blueprint $table) {
            $table->dropColumn('email_verify_token');
            $table->dropColumn('token_valid_date');
            $table->dropColumn('otp_valid_date');
        });
    }
}
