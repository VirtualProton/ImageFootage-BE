<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('order_id', 50)->nullable();
            $table->string('order_title', 255)->nullable();
            $table->decimal('subtotal', 10)->nullable();
            $table->string('user_id', 100)->nullable();
            $table->string('product_id', 100)->nullable();
            $table->string('product_type', 100)->nullable();
            $table->string('product_size', 100);
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
            $table->string('endDate', 100);
            $table->string('Industry', 100)->nullable();
            $table->string('catTitle1_name', 100)->nullable();
            $table->string('catTitle2_name', 100)->nullable();
            $table->string('catTitle3_name', 100)->nullable();
            $table->string('catTitle4_name', 100)->nullable();
            $table->string('catTitle5_name', 100)->nullable();
            $table->string('catTitle6_name', 100)->nullable();
            $table->string('catTitle7_name', 100)->nullable();
            $table->string('action', 100);
            $table->dateTime('created');
            $table->dateTime('modified');
            $table->integer('status')->nullable();
            $table->string('product_web', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
