<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeInImagefootagePerformaInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_performa_invoice_items', function (Blueprint $table) {
            $table->string('type')->after('product_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagefootage_performa_invoice_items', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
