<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagefootageFiltersOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_filters_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('filter_id');
            $table->string('option_name');
            $table->string('value');
            $table->integer('sort_order')->default(1);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            // Define foreign keys
            $table->foreign('filter_id')->references('id')->on('imagefootage_filters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_filters_options');
    }
}
