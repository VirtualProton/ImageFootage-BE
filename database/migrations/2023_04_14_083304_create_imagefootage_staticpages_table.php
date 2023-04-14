<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageStaticpagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_staticpages', function (Blueprint $table) {
            $table->bigIncrements('page_id');
            $table->string('page_title')->nullable();
            $table->string('page_url')->nullable();
            $table->string('page_meta_desc')->nullable();
            $table->string('page_meta_keywords')->nullable();
            $table->string('page_content')->nullable();
            $table->dateTime('page_added_on')->nullable();
            $table->integer('page_added_by')->nullable();
            $table->enum('image_status', ['Active', 'Inactive'])->default('Inactive');
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
        Schema::dropIfExists('imagefootage_staticpages');
    }
}
