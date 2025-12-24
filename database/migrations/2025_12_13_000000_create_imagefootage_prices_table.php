<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 
 * Create ImageFootage Prices Table Migration
 */
class CreateImagefootagePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('license_type')->comment('License Type');
            $table->string('product_type', 255)->comment('Product Type');
            $table->decimal('small_image_price', 10, 2)->nullable()->comment('Price for small image');
            $table->decimal('medium_image_price', 10, 2)->nullable()->comment('Price for medium image');
            $table->decimal('large_image_price', 10, 2)->nullable()->comment('Price for large image');
            $table->decimal('extra_large_image_price', 10, 2)->nullable()->comment('Price for extra large image');
            $table->decimal('music_price', 10, 2)->nullable()->comment('Price for music');
            $table->decimal('high_resolution_footage_price', 10, 2)->nullable()->comment('Price for high resolution footage');
            $table->decimal('4k_footage_price', 10, 2)->nullable()->comment('Price for 4K footage');
            $table->timestamps();

            $table->foreign('license_type')
                ->references('id')
                ->on('licence_type')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_prices');
    }
}
