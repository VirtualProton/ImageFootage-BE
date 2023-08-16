<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageProductfiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_productfilters', function (Blueprint $table) {
            $table->bigIncrements('filter_id');
            $table->integer('filter_product_id')->nullable();
            $table->string('filter_type')->nullable();
            $table->string('filter_type_id')->nullable();
            $table->string('filter_added_by')->nullable();
            $table->dateTime('filter_added_on')->nullable();
            $table->dateTime('filter_updated_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_productfilters');
    }
}
