<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageCurrencyConvertesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage.currency_convertes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 30);
            $table->string('cur_value', 100)->nullable();
            $table->integer('markup');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage.currency_convertes');
    }
}
