<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformaInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performa_invoices', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('user_id', 100);
            $table->string('email_id', 100);
            $table->string('invoice_name', 100);
            $table->date('created');
            $table->dateTime('modified');
            $table->integer('status');
            $table->string('mode', 100);
            $table->string('job_number', 100);
            $table->string('promo_code', 100);
            $table->decimal('tax', 10, 2);
            $table->text('tax_selected')->nullable();
            $table->integer('total');
            $table->string('invoice_type', 100);
            $table->integer('expiry_invoices');
            $table->string('address', 100);
            $table->string('address1', 100);
            $table->string('country', 110);
            $table->string('state', 110);
            $table->string('city', 110);
            $table->string('zipcode', 50);
            $table->string('deletion_date', 100);
            $table->integer('invoice_closed');
            $table->string('po_detail', 100);
            $table->string('po_image', 100);
            $table->dateTime('date_close');
            $table->string('action', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('performa_invoices');
    }
}
