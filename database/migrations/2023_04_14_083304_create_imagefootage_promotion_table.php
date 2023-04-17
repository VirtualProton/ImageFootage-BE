<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootagePromotionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_promotion', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('event_name', 255);
            $table->date('date_start');
            $table->date('date_end');
            $table->string('media_type', 255);
            $table->string('product_name', 255);
            $table->text('media_url');
            $table->text('event_des');
            $table->enum('status', ['1', '0'])->default('1');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_promotion');
    }
}
