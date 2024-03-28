<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageUsersProductsDownloadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_users_products_download', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->nullable();
            $table->integer('package_id')->nullable();
            $table->string('product_id', 255)->nullable();
            $table->string('product_id_api', 20)->nullable();
            $table->integer('id_media')->nullable();
            $table->integer('id_download')->nullable();
            $table->text('queue_hash')->nullable();
            $table->string('mimetype', 255)->nullable();
            $table->string('status', 255)->nullable();
            $table->text('download_url')->nullable();
            $table->dateTime('downloaded_date')->nullable();
            $table->dateTime('redownloded_date')->nullable();
            $table->string('product_name', 255)->nullable();
            $table->string('product_desc', 255)->nullable();
            $table->string('product_url', 255)->nullable();
            $table->string('product_size', 255)->nullable();
            $table->decimal('product_price', 10, 2)->nullable();
            $table->integer('web_type')->nullable();
            $table->string('product_poster', 255)->nullable();
            $table->string('product_thumb', 255)->nullable();
            $table->text('selected_product')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_users_products_download');
    }
}
