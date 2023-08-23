<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageFootageWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_wishlists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('name', 512)->nullable(); // Add the 'name' field with a default value of null and a maximum length of 255 characters
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_wishlists');
    }
}
