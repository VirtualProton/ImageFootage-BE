<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtendedDateToImagefootageUserPackage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_user_package', function (Blueprint $table) {
            $table->dateTime('extended_date')->nullable()->after('package_expiry_date_from_purchage');
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
            $table->dropColumn('extended_date');
        });
    }
}
