<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVersionDataToImagefootageUsercart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_usercart', function (Blueprint $table) {
            $table->text('version_data')->nullable()->after('selected_product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagefootage_usercart', function (Blueprint $table) {
            $table->dropColumn('version_data');
        });
    }
}
