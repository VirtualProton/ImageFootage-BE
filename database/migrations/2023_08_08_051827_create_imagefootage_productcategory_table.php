<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageProductcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_productcategory', function (Blueprint $table) {
            $table->bigIncrements('category_id');
            $table->string('category_name')->nullable();
            $table->integer('category_order')->nullable();
            $table->string('category_added_by')->nullable();
            $table->integer('is_display_home')->nullable()->default(0);
            $table->enum('category_status', ['Active', 'Inactive'])->default('Inactive');
            $table->dateTime('category_added_on')->nullable();
            $table->timestamps();
            $table->string('category_keywords', 300)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_productcategory');
    }
}
