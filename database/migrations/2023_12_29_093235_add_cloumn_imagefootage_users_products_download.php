<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCloumnImagefootageUsersProductsDownload extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumns('imagefootage_users_products_download',['licence_type'])){
            Schema::table('imagefootage_users_products_download', function (Blueprint $table) {
                $table->string('licence_type')->nullable();
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
        Schema::table('imagefootage_users_products_download', function (Blueprint $table) {
            $table->dropColumn('licence_type');
        });
    }
}
