<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('product_code', 100);
            $table->string('download_code', 100);
            $table->string('name', 100)->nullable();
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();
            $table->integer('subscription_type')->nullable();
            $table->decimal('small_price', 10)->nullable()->default(0)->index('price');
            $table->decimal('medium_price', 10)->nullable()->default(0);
            $table->decimal('large_price', 10)->nullable()->default(0);
            $table->decimal('xlarge_price', 10)->nullable()->default(0);
            $table->string('img_small_size', 255);
            $table->string('img_medium_size', 255);
            $table->string('img_large_size', 255);
            $table->string('img_xlarge_size', 255);
            $table->integer('active')->nullable()->default(0);
            $table->string('product_type', 10)->nullable();
            $table->integer('video_type')->default(0);
            $table->string('thumbnail_image', 255);
            $table->string('product_video', 255);
            $table->text('youtube_video');
            $table->string('product_image', 255)->nullable();
            $table->text('download_path')->nullable();
            $table->integer('new_product')->default(0);
            $table->integer('featured_product')->nullable()->default(0);
            $table->integer('popular_product')->nullable()->default(0);
            $table->string('user_post', 255);
            $table->string('user_id', 25)->nullable();
            $table->string('type', 255)->nullable();
            $table->integer('status')->default(0);
            $table->integer('ngo_id')->nullable()->default(0);
            $table->integer('donor_status')->nullable()->default(0);
            $table->string('reason', 255)->nullable();
            $table->string('other_reason', 50)->nullable();
            $table->double('rating', 10, 1)->default(0);
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
            $table->integer('check_thumb')->nullable()->default(0);
            $table->string('extension', 100)->nullable();
            $table->integer('ungraded_vid_price')->nullable();
            $table->integer('4k_vid_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
