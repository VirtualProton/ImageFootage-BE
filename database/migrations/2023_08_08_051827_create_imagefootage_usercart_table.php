<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageUsercartTable extends Migration
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
            $table->string('standard_type', 255)->nullable();
            $table->string('standard_size', 255)->nullable();
            $table->decimal('standard_price', 10, 2)->nullable();
            $table->string('extended_name', 255)->nullable();
            $table->decimal('extended_price', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->string('product_name', 255)->nullable();
            $table->string('product_main_footage', 255)->nullable();
            $table->string('product_thumb', 255)->nullable();
            $table->text('product_desc')->nullable();
            $table->text('product_json')->nullable();
            $table->text('selected_product')->nullable();
            $table->integer('product_web')->nullable();
            $table->text('token')->nullable();
            $table->integer('pricing_tier')->nullable();
            $table->string('cart_added_by')->nullable();
            $table->dateTime('cart_added_on')->nullable();
            $table->tinyInteger('status')->default(1);
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
