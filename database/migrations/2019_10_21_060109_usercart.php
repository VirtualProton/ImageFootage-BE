<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usercart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_usercart', function (Blueprint $table) {
            $table->bigIncrements('cart_id');
			$table->string('cart_product_id')->nullable();
			$table->string('cart_product_type')->nullable();
			$table->string('cart_added_by')->nullable();
			$table->dateTime('cart_added_on')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_usercart');
    }
}
