<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageProductimagesTable extends Migration
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
            $table->string('image_product_id', 225)->nullable();
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
