<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageEditorialsTable extends Migration
{
    public function up()
    {
        Schema::create('imagefootage_editorials', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title')->nullable();
            $table->enum('type', ['story', 'collection']);
            $table->string('search_term')->nullable();
            $table->text('selected_values')->nullable();
            $table->string('main_image_id', 50)->nullable();
            $table->text('main_image_selected_values')->nullable();
            $table->string('main_image_upload')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('imagefootage_editorials');
    }
}
