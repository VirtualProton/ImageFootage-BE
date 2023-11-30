<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_id')->nullable();
            $table->bigInteger('api_product_id')->nullable()->index('api_product_id');
            $table->bigInteger('product_category')->nullable();
            $table->string('product_subcategory')->nullable();
            $table->string('product_owner', 255)->nullable();
            $table->text('product_title')->nullable();
            $table->string('product_vertical')->nullable();
            $table->text('product_keywords')->nullable();
            $table->text('product_description')->nullable();
            $table->string('product_thumbnail', 255)->nullable();
            $table->string('product_main_image', 255)->nullable();
            $table->string('product_release_details')->nullable();
            $table->decimal('product_price_small', 10, 2)->nullable();
            $table->decimal('product_price_medium', 10, 2)->nullable();
            $table->decimal('product_price_large', 10, 2)->nullable();
            $table->decimal('product_price_extralarge', 10, 2)->nullable();
            $table->string('product_size')->nullable();
            $table->string('product_added_by')->nullable();
            $table->enum('product_status', ['Active', 'Inactive'])->default('Inactive');
            $table->enum('product_main_type', ['Image', 'Footage', 'Editorial'])->default('Image');
            $table->enum('product_sub_type', ['Footage', 'Vector', 'Photo', 'Illustrator'])->default('Photo');
            $table->dateTime('product_added_on')->nullable();
            $table->string('product_verification', 225)->nullable();
            $table->string('product_rejectod_reason', 225)->nullable();
            $table->string('product_editedby', 300)->nullable();
            $table->integer('product_web')->nullable()->default(1)->comment('1->imagefootage,2->panthermedia,3->pond5');
            $table->string('license_type', 225)->nullable()->default('standard');
            $table->integer('width_thumb')->nullable();
            $table->integer('height_thumb')->nullable();
            $table->integer('thumb_update_status')->nullable()->default(1);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable();

            $table->index(['product_id', 'api_product_id', 'product_status', 'product_web'], 'product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_products');
    }
}
