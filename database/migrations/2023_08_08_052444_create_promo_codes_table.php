<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->integer('max_usage')->nullable();
            $table->integer('total_applied_code')->nullable();
            $table->string('discount', 255)->nullable();
            $table->string('valid_upto_type', 255)->nullable();
            $table->date('valid_start_date')->nullable();
            $table->date('valid_till_date')->nullable();
            $table->enum('status', ['1', '0'])->default('1');
            $table->enum('will_apply_by', ['1', '2', '3'])->comment('1- frontend, 2- backend, 3- all')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promo_codes');
    }
}
