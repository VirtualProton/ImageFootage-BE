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
        // Check if column doesn't exist before adding
        if (!Schema::hasColumn('imagefootage_wishlist_products', 'pond5_product_response')) {
            Schema::table('imagefootage_wishlist_products', function (Blueprint $table) {
                $table->text('pond5_product_response')->nullable()->after('product_id');
            });
        }
        
        // Drop foreign key if it exists using raw SQL
        $foreignKeyExists = \DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.TABLE_CONSTRAINTS 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'imagefootage_wishlist_products' 
            AND CONSTRAINT_NAME = 'imagefootage_wishlist_products_ibfk_2'
        ");
        
        if (!empty($foreignKeyExists)) {
            \DB::statement('ALTER TABLE imagefootage_wishlist_products DROP FOREIGN KEY imagefootage_wishlist_products_ibfk_2');
        }
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
