<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductcategoryTable extends Migration
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
			$table->string('category_order')->nullable();
			$table->string('category_added_by')->nullable();
			$table->enum('category_status', ['Active', 'Inactive'])->default('Inactive');
			$table->dateTime('category_added_on')->nullable();
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
        Schema::dropIfExists('imagefootage_productcategory');
    }
}
