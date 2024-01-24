<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnExtraDetailsInPerformaInvoiceItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumns('imagefootage_performa_invoice_items',['extra_details'])){
            Schema::table('imagefootage_performa_invoice_items', function (Blueprint $table) {
                $table->text('extra_details')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagefootage_performa_invoice_items', function (Blueprint $table) {
            $table->dropColumn('extra_details');
        });
    }
}
