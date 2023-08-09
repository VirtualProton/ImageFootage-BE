<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootagePerformaInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_performa_invoice_items', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('invoice_id')->nullable();
            $table->string('user_id', 50)->nullable();
            $table->string('product_id', 100)->nullable();
            $table->string('type')->nullable();
            $table->string('product_type', 50)->nullable();
            $table->string('product_size', 50)->nullable();
            $table->string('product_image', 255)->nullable();
            $table->integer('subtotal')->nullable();
            $table->integer('product_subscription')->nullable();
            $table->string('plan_id', 50)->nullable();
            $table->integer('status')->nullable();
            $table->string('product_web', 100)->nullable();
            $table->string('action', 100)->nullable();
            $table->string('catTitle1', 100)->nullable()->default('');
            $table->string('catTitle2', 100)->nullable();
            $table->string('catTitle3', 100)->nullable();
            $table->string('catTitle4', 100)->nullable();
            $table->string('catTitle5', 100)->nullable();
            $table->string('catTitle6', 100)->nullable();
            $table->string('catTitle7', 100)->nullable();
            $table->string('catValue1', 100)->nullable();
            $table->string('catValue2', 100)->nullable();
            $table->string('catValue3', 100)->nullable();
            $table->string('catValue4', 100)->nullable();
            $table->string('catValue5', 100)->nullable();
            $table->string('catValue6', 100)->nullable();
            $table->string('catValue7', 100)->nullable();
            $table->string('duration', 100)->nullable();
            $table->string('start_date', 100)->nullable();
            $table->string('end_date', 100)->nullable();
            $table->string('teritery_type', 100)->nullable();
            $table->string('teritery1', 100)->nullable();
            $table->string('teritery2', 100)->nullable();
            $table->string('teritery3', 100)->nullable();
            $table->string('userindustry', 100)->nullable();
            $table->string('username', 100)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('modified_at')->nullable();
            $table->integer('purchase_product')->nullable();
            $table->longText('licence_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_performa_invoice_items');
    }
}
