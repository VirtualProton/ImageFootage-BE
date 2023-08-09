<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPaymentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_payment_infos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('payment_type', 50)->nullable();
            $table->integer('payment_limit')->nullable();
            $table->string('user_id', 100)->nullable();
            $table->string('payment_mode', 50)->nullable();
            $table->string('account_id', 100);
            $table->string('bank_details', 100);
            $table->dateTime('payment_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_payment_infos');
    }
}
