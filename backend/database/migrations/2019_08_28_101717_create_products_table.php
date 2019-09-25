<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
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
			$table->string('product_category')->nullable();
			$table->string('product_subcategory')->nullable();
			$table->string('product_owner')->nullable();
			$table->string('product_title')->nullable();
			$table->string('product_vertical')->nullable();
			$table->string('product_keywords')->nullable();
			$table->string('product_thumbnail')->nullable();
			$table->string('product_main_image')->nullable();
			$table->string('product_release_details')->nullable();
			$table->string('product_price_small')->nullable();
			$table->string('product_price_medium')->nullable();
			$table->string('product_price_large')->nullable();
			$table->string('product_price_extralarge')->nullable();
			$table->string('product_size')->nullable();
			$table->string('product_added_by')->nullable();
			$table->enum('product_status', ['Active', 'Inactive'])->default('Inactive');
			$table->enum('product_main_type', ['Image', 'Footage','Editorial'])->default('Image');
			$table->enum('product_sub_type', ['Footage','Vector','Photo','Illustrator'])->default('Photo');
			$table->string('product_verification')->nullable();
			$table->string('product_rejectod_reason')->nullable();
			$table->dateTime('product_added_on')->nullable();
            $table->timestamps();
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
