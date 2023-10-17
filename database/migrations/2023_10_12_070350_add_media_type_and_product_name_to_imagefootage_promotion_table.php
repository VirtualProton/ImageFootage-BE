<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMediaTypeAndProductNameToImagefootagePromotionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('imagefootage_promotion', 'media_type')) {
            Schema::table('imagefootage_promotion', function (Blueprint $table) {
                $table->string('media_type', 255);
            });
        }
        if (!Schema::hasColumn('imagefootage_promotion', 'product_name')) {
            Schema::table('imagefootage_promotion', function (Blueprint $table) {
                $table->string('product_name', 255);
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
        if (Schema::hasColumn('imagefootage_promotion', 'media_type')) {
            Schema::table('imagefootage_promotion', function (Blueprint $table) {
                $table->dropColumn('media_type', 255);
            });
        }
        if (Schema::hasColumn('imagefootage_promotion', 'product_name')) {
            Schema::table('imagefootage_promotion', function (Blueprint $table) {
                $table->dropColumn('product_name', 255);
            });
        }
    }
}
