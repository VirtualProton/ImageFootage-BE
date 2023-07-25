<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('attribute_id')->nullable()->index('attribute_id');
            $table->string('name', 255)->nullable();
            $table->string('color_code', 100)->nullable();
            $table->integer('active')->nullable()->default(1)->index('pav_active');
            $table->integer('sort_order')->nullable();
            $table->dateTime('created')->nullable()->index('created');
            $table->dateTime('modified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attribute_values');
    }
}
