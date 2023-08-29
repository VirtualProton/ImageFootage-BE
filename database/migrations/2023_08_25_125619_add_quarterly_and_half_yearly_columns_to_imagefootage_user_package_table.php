<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQuarterlyAndHalfYearlyColumnsToImagefootageUserPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_user_package', function (Blueprint $table) {
            $table->integer('package_expiry_quarterly')->nullable();
            $table->integer('package_expiry_half_yearly')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagefootage_user_package', function (Blueprint $table) {
            //
        });
    }
}
