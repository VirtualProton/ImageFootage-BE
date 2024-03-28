<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_messages', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('page_type', 255);
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('link', 255);
            $table->string('button_text', 255);
            $table->integer('status');
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
        Schema::dropIfExists('discount_messages');
    }
}
