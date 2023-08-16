<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentByToImagefootagePerformaInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_performa_invoices', function (Blueprint $table) {
            $table->integer('payment_by')->comment('payment by 1- frontend 0- backend')->default('1')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagefootage_performa_invoices', function (Blueprint $table) {
            $table->dropColumn('payment_by');
        });
    }
}
