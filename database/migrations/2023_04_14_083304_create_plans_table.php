<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title', 255);
            $table->text('description');
            $table->decimal('monthly_price', 10)->default(0);
            $table->decimal('yearly_price', 10)->default(0);
            $table->integer('duration');
            $table->integer('maximage_download')->nullable();
            $table->integer('maxvectors_download')->nullable();
            $table->integer('maxfootage_download')->nullable();
            $table->integer('maxaudio_download')->nullable();
            $table->integer('image_download');
            $table->integer('vector_download');
            $table->string('plan_type', 50);
            $table->integer('active')->default(0);
            $table->dateTime('created');
            $table->dateTime('modified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
