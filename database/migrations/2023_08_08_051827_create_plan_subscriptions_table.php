<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_subscriptions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('plan_id')->nullable();
            $table->string('user_id', 100)->nullable();
            $table->integer('order_id');
            $table->string('plan_title', 11)->nullable();
            $table->integer('maximage_download')->nullable();
            $table->integer('maxvectors_download')->nullable();
            $table->integer('maxfootage_download')->nullable();
            $table->decimal('plan_price', 10, 2);
            $table->string('plan_validity', 255)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('status')->default(0);
            $table->integer('payment_status')->default(0);
            $table->integer('payment_type')->nullable();
            $table->string('action', 100);
            $table->dateTime('created');
            $table->dateTime('modified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_subscriptions');
    }
}
