<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformaInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performa_invoice_items', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('invoice_id');
            $table->string('user_id', 50);
            $table->string('product_id', 100);
            $table->string('product_type', 50);
            $table->string('product_size', 50);
            $table->integer('subtotal');
            $table->integer('product_subscription');
            $table->string('plan_id', 50);
            $table->integer('status');
            $table->string('product_web', 100)->nullable();
            $table->string('action', 100);
            $table->string('catTitle1', 100)->default('');
            $table->string('catTitle2', 100);
            $table->string('catTitle3', 100);
            $table->string('catTitle4', 100);
            $table->string('catTitle5', 100);
            $table->string('catTitle6', 100);
            $table->string('catTitle7', 100);
            $table->string('catValue1', 100);
            $table->string('catValue2', 100);
            $table->string('catValue3', 100);
            $table->string('catValue4', 100);
            $table->string('catValue5', 100);
            $table->string('catValue6', 100);
            $table->string('catValue7', 100);
            $table->string('duration', 100);
            $table->string('start_date', 100);
            $table->string('end_date', 100);
            $table->string('teritery_type', 100);
            $table->string('teritery1', 100);
            $table->string('teritery2', 100);
            $table->string('teritery3', 100);
            $table->string('userindustry', 100);
            $table->string('username', 100);
            $table->dateTime('created');
            $table->dateTime('modified');
            $table->integer('purchase_product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('performa_invoice_items');
    }
}
