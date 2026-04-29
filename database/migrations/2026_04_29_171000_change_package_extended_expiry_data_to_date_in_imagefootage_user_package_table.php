<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangePackageExtendedExpiryDataToDateInImagefootageUserPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('imagefootage_user_package', 'package_extended_expiry_data')) {
            DB::statement('ALTER TABLE `imagefootage_user_package` MODIFY `package_extended_expiry_data` DATE NULL');
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
            DB::statement('ALTER TABLE `imagefootage_user_package` MODIFY `package_extended_expiry_data` TEXT NULL');
        }
    }
}
