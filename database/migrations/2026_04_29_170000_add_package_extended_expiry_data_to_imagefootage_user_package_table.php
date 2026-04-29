<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPackageExtendedExpiryDataToImagefootageUserPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('imagefootage_user_package', 'package_extended_expiry_data')) {
            Schema::table('imagefootage_user_package', function (Blueprint $table) {
                $table->text('package_extended_expiry_data')
                    ->nullable()
                    ->after('package_expiry_date_from_purchage');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('imagefootage_user_package', 'package_extended_expiry_data')) {
            Schema::table('imagefootage_user_package', function (Blueprint $table) {
                $table->dropColumn('package_extended_expiry_data');
            });
        }
    }
}
