<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_accounts', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('account_name', 100);
            $table->string('phone', 20);
            $table->string('email', 100);
            $table->string('website', 200)->nullable();
            $table->text('bill_address')->nullable();
            $table->integer('bill_city')->nullable();
            $table->integer('bill_state')->nullable();
            $table->integer('bill_country')->nullable();
            $table->bigInteger('bill_postal')->nullable();
            $table->integer('industry_type_id')->nullable();
            $table->integer('curruncy_id')->nullable();
            $table->enum('global_region', ['AS', 'UAE', 'US', 'AU', 'UK'])->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->enum('domestic_region', ['IN'])->nullable();
            $table->dateTime('created_at')->nullable();
            $table->timestamp('updated_at');
            $table->string('contact_name')->nullable();
            $table->string('title')->nullable();
            $table->string('mobile')->nullable();
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
        Schema::dropIfExists('imagefootage_accounts');
    }
}
