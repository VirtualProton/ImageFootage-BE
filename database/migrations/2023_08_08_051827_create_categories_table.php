<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('parent_id')->nullable()->default(0)->index('parent_id');
            $table->string('name', 255)->nullable()->index('name');
            $table->string('image', 255)->nullable();
            $table->integer('position')->nullable()->default(0)->index('position');
            $table->tinyInteger('active')->nullable()->default(0)->index('active');
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
