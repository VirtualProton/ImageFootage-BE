<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesPerformaInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_performa_invoices', function (Blueprint $table) {
            // Add individual indexes for commonly filtered columns
            $table->index('user_id', 'idx_performa_user_id');
            $table->index('invoice_type', 'idx_performa_invoice_type');
            $table->index('proforma_type', 'idx_performa_proforma_type');
            $table->index('payment_status', 'idx_performa_payment_status');
            $table->index('cancelled_by', 'idx_performa_cancelled_by');
            
            // Add composite indexes for common query combinations
            $table->index(['user_id', 'proforma_type'], 'idx_performa_user_proforma');
            $table->index(['user_id', 'invoice_type', 'proforma_type'], 'idx_performa_user_type');
            $table->index(['user_id', 'flag', 'invoice_type'], 'idx_performa_user_flag_type');
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
            $table->dropIndex('idx_performa_user_id');
            $table->dropIndex('idx_performa_invoice_type');
            $table->dropIndex('idx_performa_proforma_type');
            $table->dropIndex('idx_performa_payment_status');
            $table->dropIndex('idx_performa_cancelled_by');
            $table->dropIndex('idx_performa_user_proforma');
            $table->dropIndex('idx_performa_user_type');
            $table->dropIndex('idx_performa_user_flag_type');
        });
    }
}
