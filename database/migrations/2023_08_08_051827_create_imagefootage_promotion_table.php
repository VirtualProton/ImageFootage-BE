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
            $table->integer('id');
            $table->string('event_name', 255);
            $table->text('media_url');
            $table->text('event_des');
            $table->enum('status', ['1', '0'])->default('1');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('page_type', 20)->nullable();
            $table->string('desktop_banner_image', 255)->nullable();
            $table->string('mobile_banner_image', 255)->nullable();
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
