<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGstPanFieldsToAccountImagefootageUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_users', function (Blueprint $table) {
            //
            $table->string('gst')->nullable();
            $table->string('pan')->nullable();
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
            //
            $table->dropColumn('gst');
            $table->dropColumn('pan');
        });
    }
}
