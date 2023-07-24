<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_carts', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('session_id', 255)->nullable()->index('session_id');
            $table->string('product_id', 100)->nullable()->index('product_id');
            $table->integer('quantity')->nullable();
            $table->decimal('price', 10)->nullable();
            $table->string('status', 50);
            $table->string('attribute_id', 255)->nullable();
            $table->string('attribute_value_id', 255)->nullable();
            $table->string('attribute_name', 255)->nullable();
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
            $table->string('size', 255)->nullable();
            $table->string('user_id', 100)->nullable();
            $table->string('product_type', 50)->nullable();
            $table->string('usageType', 50)->nullable();
            $table->string('type_of_usage', 50)->nullable();
            $table->string('catDisplay2', 50)->nullable();
            $table->string('catDisplay3', 100)->nullable();
            $table->string('catDisplay4', 100)->nullable();
            $table->string('catDisplay5', 100)->nullable();
            $table->string('catDisplay6', 100)->nullable();
            $table->string('catDisplay7', 100)->nullable();
            $table->string('territoryType', 100)->nullable();
            $table->string('Territory', 100)->nullable();
            $table->string('Territory1', 100)->nullable();
            $table->string('Territory2', 100)->nullable();
            $table->string('Duration', 100)->nullable();
            $table->string('StartYear', 100)->nullable();
            $table->string('Industry', 100)->nullable();
            $table->string('catTitle1_name', 100)->nullable();
            $table->string('catTitle2_name', 100)->nullable();
            $table->string('catTitle3_name', 100)->nullable();
            $table->string('catTitle4_name', 100)->nullable();
            $table->string('catTitle5_name', 100)->nullable();
            $table->string('catTitle6_name', 100)->nullable();
            $table->string('catTitle7_name', 100)->nullable();
            $table->string('endDate', 100);
            $table->string('product_web', 100)->nullable();
            $table->text('pond_cart_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping_carts');
    }
}
