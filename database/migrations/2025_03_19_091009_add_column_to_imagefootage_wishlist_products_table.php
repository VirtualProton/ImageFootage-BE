<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToImagefootageWishlistProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_wishlist_products', function (Blueprint $table) {
            $table->text('pond5_product_response')->nullable()->after('product_id');
            //remove forain key from product_id
            $table->dropForeign('imagefootage_wishlist_products_ibfk_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagefootage_wishlist_products', function (Blueprint $table) {
            $table->dropColumn('pond5_product_response');
            //add forain key from product_id
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }
}
