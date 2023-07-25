<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageWishlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_wishlist', function (Blueprint $table) {
            $table->integer('wishlist_id', true);
            $table->string('wishlist_product', 45);
            $table->integer('wishlist_user_id')->nullable();
            $table->string('folder_name', 50)->nullable();
            $table->dateTime('wishlist_added_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_wishlist');
    }
}
