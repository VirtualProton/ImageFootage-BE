<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->enum('product_main_type', array('Image', 'Footage', 'Editorial', 'Music'))->change();
            $table->enum('product_sub_type', array('Footage', 'Vector', 'Photo', 'Illustrator', 'Music'))->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagefootage_products', function (Blueprint $table) {
            $table->enum('product_main_type', array('Image', 'Footage', 'Editorial'))->change();
            $table->enum('product_sub_type', array('Footage', 'Vector', 'Photo', 'Illustrator'))->change();
        });
    }
}
