<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductPathIdToImagefootageWishlistProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('imagefootage_wishlist_products', function (Blueprint $table) {
            $table->string('product_path_id', 191)->after('product_id');
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
            $table->dropColumn('product_path_id');
        });
    }
}
