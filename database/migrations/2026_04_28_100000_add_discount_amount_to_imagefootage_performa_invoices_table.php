<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountAmountToImagefootagePerformaInvoicesTable extends Migration
{
    public function up()
    {
        Schema::table('imagefootage_performa_invoices', function (Blueprint $table) {
            $table->float('discount_amount')->nullable()->default(null)->after('tax');
        });
    }

    public function down()
    {
        Schema::table('imagefootage_performa_invoices', function (Blueprint $table) {
            $table->dropColumn('discount_amount');
        });
    }
}
