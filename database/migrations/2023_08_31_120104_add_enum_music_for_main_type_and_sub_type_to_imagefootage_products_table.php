<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddEnumMusicForMainTypeAndSubTypeToImagefootageProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_products', function (Blueprint $table) {
            //$table->enum('product_main_type', array('Image', 'Footage', 'Editorial', 'Music'))->change();
            //$table->enum('product_sub_type', array('Footage', 'Vector', 'Photo', 'Illustrator', 'Music'))->change();
            DB::statement('ALTER TABLE `imagefootage_products` CHANGE `product_main_type` `product_main_type` ENUM("Image","Footage","Editorial","Music") NOT NULL DEFAULT "Image";');
            DB::statement('ALTER TABLE `imagefootage_products` CHANGE `product_sub_type` `product_sub_type` ENUM("Footage","Vector","Photo","Illustrator","Music") NOT NULL DEFAULT "Photo";');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
