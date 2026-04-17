<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCurrencyToImagefootagePerformaInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_performa_invoices', function (Blueprint $table) {
            $table->string('currency')->nullable()->default('INR')->comment('Currency: INR or USD');
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
            $table->dropColumn('currency');
        });
    }
}
