<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraColumsToImagefootageAccountsTable extends Migration
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
            // You probably want to make the new column nullable
             $table->string('contact_name')->nullable();
             $table->string('title')->nullable();
             $table->string('mobile')->nullable();
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
            $table->dropColumn('contact_name');
            $table->dropColumn('title');
            $table->dropColumn('mobile');

        });
    }
}
