<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagefootageWishlistProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_wishlist_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('wishlist_id');
            $table->unsignedBigInteger('product_id');
            $table->enum('type', ['image', 'footage', 'music']); // Add the 'type' enum field
            $table->timestamps();
    
            // Define foreign keys
            $table->foreign('wishlist_id')->references('id')->on('imagefootage_wishlists')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('imagefootage_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_wishlist_products');
    }
}
