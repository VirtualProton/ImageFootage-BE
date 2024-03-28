<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_banners', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 255)->nullable()->index('name');
            $table->string('banner_image', 255)->nullable();
            $table->string('banner_link', 255)->nullable();
            $table->string('short_description', 250)->nullable();
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
        Schema::dropIfExists('manage_banners');
    }
}
