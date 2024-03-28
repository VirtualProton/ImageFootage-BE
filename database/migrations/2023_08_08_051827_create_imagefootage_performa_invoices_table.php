<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootagePerformaInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_performa_invoices', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->string('email_id', 100)->nullable();
            $table->string('invoice_name', 100)->nullable();
            $table->integer('promo_code_id')->nullable();
            $table->integer('package_id')->nullable();
            $table->dateTime('created');
            $table->dateTime('modified');
            $table->integer('status')->default(0)->comment('(0-pending,1-approve,2-purched,3-cancel');
            $table->string('mode', 100)->nullable();
            $table->string('job_number', 100)->nullable();
            $table->string('promo_code', 100)->nullable();
            $table->decimal('tax', 10, 2)->nullable();
            $table->text('tax_selected')->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->integer('quotation_id')->nullable();
            $table->integer('invoice_type')->nullable()->comment('(1-subscriber,2-download,3-custom)');
            $table->integer('proforma_type')->nullable()->comment('(1-quotation,2-invoice)');
            $table->integer('expiry_invoices')->nullable();
            $table->string('address', 100)->nullable();
            $table->string('address1', 100)->nullable();
            $table->string('country', 110)->nullable();
            $table->string('state', 110)->nullable();
            $table->string('city', 110)->nullable();
            $table->string('zipcode', 50)->nullable();
            $table->dateTime('cancel_date')->nullable();
            $table->integer('invoice_closed')->nullable();
            $table->string('po_detail', 100)->nullable();
            $table->string('po_image', 100)->nullable();
            $table->dateTime('date_close')->nullable();
            $table->text('action_comment')->nullable();
            $table->text('quotation_url')->nullable();
            $table->text('invoice_url')->nullable();
            $table->string('payment_status', 50)->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->text('payment_response')->nullable();
            $table->string('payment_mode', 50)->nullable();
            $table->dateTime('invoice_created')->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->integer('flag')->nullable();
            $table->string('end_client', 255)->nullable();
            $table->integer('expiry_due_date')->nullable();
            $table->integer('cancelled_by')->nullable()->comment('cancelled by user id, if null then cancelled by cron');
            $table->dateTime('cancelled_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_performa_invoices');
    }
}
