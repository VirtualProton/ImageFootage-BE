<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Productimages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('imagefootage_productimages', function (Blueprint $table) {
            $table->bigIncrements('image_id');
			$table->string('image_name')->nullable();
			$table->integer('image_product_id')->nullable();
			$table->dateTime('image_added_on')->nullable();
			$table->integer('image_added_by')->nullable();
			$table->enum('image_status', ['Active', 'Inactive'])->default('Inactive');
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
       Schema::dropIfExists('imagefootage_productimages');
    }
}
