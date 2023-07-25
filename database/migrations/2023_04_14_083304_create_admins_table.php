<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('username', 255)->index('username');
            $table->string('password', 255)->index('password');
            $table->enum('type', ['SITE', 'CRMUSERS', 'ADMIN', 'SALES'])->default('SITE');
            $table->integer('status')->index('status');
            $table->string('firstname', 255);
            $table->string('lastname', 255);
            $table->string('email', 255);
            $table->integer('add_crm_user');
            $table->integer('add_products');
            $table->integer('transaction');
            $table->integer('abandond_cart_list');
            $table->integer('advance_member_search');
            $table->integer('search_client_information');
            $table->integer('transaction_search');
            $table->integer('sale_n_transactions');
            $table->integer('performa_invoice_search');
            $table->integer('recent_cancelled_transaction');
            $table->integer('clientResigestred_list');
            $table->integer('download_facility');
            $table->integer('download_on_behalf');
            $table->integer('low_remaning_credit');
            $table->integer('daily_tasks');
            $table->integer('add_potential_user');
            $table->string('state', 255);
            $table->string('country', 50);
            $table->integer('countryAcess');
            $table->integer('buyerAcess');
            $table->integer('contributorAcess');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
