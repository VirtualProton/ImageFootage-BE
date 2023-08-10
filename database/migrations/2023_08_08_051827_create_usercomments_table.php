<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsercommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usercomments', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('subject', 100);
            $table->string('user_id', 100);
            $table->text('message');
            $table->string('status', 50);
            $table->string('agent', 100);
            $table->integer('seen_by_agent')->nullable()->default(0);
            $table->integer('sent_by');
            $table->string('hashtag', 100);
            $table->string('expiry', 100);
            $table->dateTime('created');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usercomments');
    }
}
