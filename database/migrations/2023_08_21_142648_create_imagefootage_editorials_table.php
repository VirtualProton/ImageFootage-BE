<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageEditorialsTable extends Migration
{
    public function up()
    {
        Schema::create('imagefootage_editorials', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('search_term', 255);
            $table->enum('type', ['story', 'collection']);
            $table->unsignedBigInteger('main_image_id')->nullable();
            $table->text('selected_values')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('imagefootage_editorials');
    }
}
