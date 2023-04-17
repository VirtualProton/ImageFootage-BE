<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('user_id', 100)->nullable();
            $table->string('txn_id', 255)->nullable();
            $table->integer('plan_id')->nullable();
            $table->string('invoice', 100)->nullable();
            $table->string('download_plan_id', 50)->nullable();
            $table->string('download_plan_title', 50);
            $table->decimal('tax', 10)->nullable();
            $table->text('tax_selected')->nullable();
            $table->string('coupon_code', 100)->nullable();
            $table->string('coupon_type', 50)->nullable();
            $table->double('coupon_value')->nullable();
            $table->double('coupon_discount')->nullable();
            $table->decimal('order_total', 10)->nullable();
            $table->date('order_date')->nullable();
            $table->integer('order_status')->nullable()->default(0);
            $table->string('order_title', 100);
            $table->string('order_cancel_status', 100);
            $table->integer('order_type')->nullable();
            $table->string('order_email', 100)->nullable();
            $table->string('ip', 100)->nullable();
            $table->string('payment_mode', 100)->nullable();
            $table->string('cc_number', 100)->nullable();
            $table->string('cc_expiry_date', 100)->nullable();
            $table->string('job_number', 100)->nullable();
            $table->string('po_detail', 100)->nullable();
            $table->string('po_image', 100)->nullable();
            $table->text('order_comments')->nullable();
            $table->string('bill_firstname', 100)->nullable();
            $table->string('bill_lastname', 100)->nullable();
            $table->string('bill_address1', 100)->nullable();
            $table->string('bill_address2', 100)->nullable();
            $table->string('bill_city', 100)->nullable();
            $table->string('bill_state', 100)->nullable();
            $table->string('bill_zip', 100)->nullable();
            $table->string('bill_country', 100)->nullable();
            $table->string('bill_phone', 100)->nullable();
            $table->dateTime('created');
            $table->dateTime('modified');
            $table->string('invoice_type', 100)->nullable();
            $table->integer('expiry_invoices')->nullable();
            $table->string('deletion_date', 200)->nullable();
            $table->integer('invoice_closed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
