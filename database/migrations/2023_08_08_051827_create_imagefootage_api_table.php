<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageApiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_api', function (Blueprint $table) {
            $table->integer('api_id', true);
            $table->string('api_provider', 100)->nullable();
            $table->string('detail', 100)->nullable();
            $table->string('api_slug', 255)->nullable();
            $table->decimal('api_amount', 10, 2)->nullable();
            $table->string('api_flag', 5)->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_api');
    }
}
