<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributeRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_relations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('product_id')->nullable();
            $table->integer('attribute_id')->nullable()->index('attribute_id');
            $table->integer('attribute_value_id')->nullable()->index('prod_att_rel_attrbval');
            $table->string('quantity', 255)->nullable();

            $table->unique(['product_id', 'attribute_id', 'attribute_value_id'], 'attribute_unique_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attribute_relations');
    }
}
