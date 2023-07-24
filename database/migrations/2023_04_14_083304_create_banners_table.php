<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title', 255)->nullable()->index('title');
            $table->string('banner_image', 255)->nullable();
            $table->string('url_link', 255)->nullable();
            $table->integer('sort')->nullable()->default(0)->index('sort');
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
        Schema::dropIfExists('banners');
    }
}
