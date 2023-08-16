<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDisplayForToImagefootagePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_packages', function (Blueprint $table) {
            $table->tinyInteger('display_for')->nullable()->comment('1=Frontend,2=Backend,3=All');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagefootage_packages', function (Blueprint $table) {
            $table->dropColumn('display_for');
        });
    }
}
