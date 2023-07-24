<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageCrmProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_crm_products', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('product_code', 100);
            $table->bigInteger('api_product_id')->nullable();
            $table->string('name', 100);
            $table->string('keywords', 100);
            $table->text('description')->nullable();
            $table->string('product_type', 50);
            $table->integer('subscription_type');
            $table->string('type', 50);
            $table->string('video_type', 50);
            $table->string('product_image', 250);
            $table->string('product_video', 250);
            $table->string('thumbnail_image', 100)->nullable();
            $table->integer('featured_product');
            $table->integer('new_product');
            $table->integer('popular_product');
            $table->double('rating', 10, 1);
            $table->integer('active');
            $table->string('small_size', 50);
            $table->string('medium_size', 50);
            $table->string('large_size', 50);
            $table->string('x_large_size', 50);
            $table->string('user_post', 100);
            $table->string('user_id', 100);
            $table->dateTime('created');
            $table->dateTime('modified');
            $table->integer('product_web')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_crm_products');
    }
}
