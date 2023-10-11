<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductIdAndImagePathToImagefootageProductcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_productcategory', function (Blueprint $table) {
            $table->string('product_id', 50);
            $table->string('image_path', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagefootage_productcategory', function (Blueprint $table) {
            $table->dropColumn('product_id');
            $table->dropColumn('image_path');
        });
    }
}
