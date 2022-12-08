<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBankFieldsToAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_accounts', function (Blueprint $table) {
            //
            $table->string('bank_name')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagefootage_accounts', function (Blueprint $table) {
            //
            $table->dropColumn('bank_name');
            $table->dropColumn('account_holder_name');
            $table->dropColumn('account_number');
            $table->dropColumn('ifsc');
        });
    }
}
