<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('code', 255);
            $table->string('from_date', 255);
            $table->string('to_date', 255);
            $table->string('coupon_value', 255);
            $table->integer('maximum_uses')->nullable();
            $table->integer('number_of_uses')->nullable();
            $table->string('coupon_type', 255);
            $table->text('description');
            $table->string('active', 255);
            $table->string('used_by_users', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
