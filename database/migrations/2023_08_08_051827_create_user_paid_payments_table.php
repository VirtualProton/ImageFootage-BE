<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPaidPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_paid_payments', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('user_id', 100);
            $table->string('payment_paid_mode', 50);
            $table->integer('payment_paid');
            $table->string('payment_date', 50);
            $table->integer('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_paid_payments');
    }
}
