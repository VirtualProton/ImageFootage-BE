<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateEmailNullableToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_users', function (Blueprint $table) {
            DB::statement('ALTER TABLE `imagefootage_users` CHANGE `email` `email` VARCHAR(191) NULL;');
            DB::statement('ALTER TABLE `imagefootage_users` DROP INDEX imagefootage_users_email_unique;');
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
            DB::statement('ALTER TABLE `imagefootage_users` CHANGE `email` `email` VARCHAR(191) NOT NULL;');
            DB::statement('ALTER TABLE `imagefootage_users` ADD CONSTRAINT imagefootage_users_email_unique UNIQUE (email);');
        });
    }
}
