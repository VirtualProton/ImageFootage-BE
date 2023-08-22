<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagefootageUsersWishlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_users_wishlist', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('wishlist_id');
            $table->timestamps();

            // Define foreign keys
            $table->foreign('user_id')->references('id')->on('imagefootage_users')->onDelete('cascade');
            $table->foreign('wishlist_id')->references('id')->on('imagefootage_wishlists')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_users_wishlist');
    }
}
