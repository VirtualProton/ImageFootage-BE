<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageProductsubcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_productsubcategory', function (Blueprint $table) {
            $table->bigIncrements('subcategory_id');
            $table->string('category_id')->nullable();
            $table->string('subcategory_name')->nullable();
            $table->string('subcategory_order')->nullable();
            $table->string('subcategory_added_by')->nullable();
            $table->dateTime('subcategory_added_on')->nullable();
            $table->enum('subcategory_status', ['Active', 'Inactive'])->default('Inactive');
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
        Schema::dropIfExists('imagefootage_productsubcategory');
    }
}
