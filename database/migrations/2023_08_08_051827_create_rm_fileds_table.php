<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRmFiledsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rm_fileds', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('label', 100);
            $table->string('value', 100);
            $table->integer('heading_id')->index('heading_id');
            $table->integer('main_cat_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rm_fileds');
    }
}
