<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagefootageSharedWishlistsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_shared_wishlists_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('shared_by_user_id');
            $table->unsignedBigInteger('shared_wishlist_id');
            $table->unsignedBigInteger('shared_with_user_id');
            $table->unsignedBigInteger('new_wishlist_id');
            $table->text('shared_product_ids')->nullable(true);
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('shared_by_user_id')->references('id')->on('imagefootage_users');
            $table->foreign('shared_wishlist_id')->references('id')->on('imagefootage_wishlists');
            $table->foreign('shared_with_user_id')->references('id')->on('imagefootage_users');
            $table->foreign('new_wishlist_id')->references('id')->on('imagefootage_wishlists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_shared_wishlists_logs');
    }
}
