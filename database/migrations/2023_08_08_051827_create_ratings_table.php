<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->nullable()->index('user_id');
            $table->integer('product_id')->nullable()->index('product_id');
            $table->integer('overall')->default(0);
            $table->integer('comfort')->default(0);
            $table->integer('style')->default(0);
            $table->string('name', 255)->nullable();
            $table->string('email', 150)->nullable();
            $table->text('review')->nullable();
            $table->boolean('active')->default(true)->index('active');
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
        Schema::dropIfExists('ratings');
    }
}
