<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageUserPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_user_package', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('transaction_id')->nullable();
            $table->bigInteger('user_id');
            $table->bigInteger('package_id');
            $table->string('package_name')->nullable();
            $table->decimal('package_price', 10, 2)->nullable();
            $table->string('package_description')->nullable();
            $table->integer('package_products_count')->nullable();
            $table->string('package_type')->nullable();
            $table->integer('package_expiry')->nullable();
            $table->string('package_plan', 225)->nullable();
            $table->integer('package_permonth_download')->nullable();
            $table->string('package_pcarry_forward', 225)->nullable();
            $table->text('invoice')->nullable();
            $table->string('package_expiry_yearly', 225)->nullable();
            $table->dateTime('package_expiry_date_from_purchage')->nullable();
            $table->integer('downloaded_product')->nullable()->default(0);
            $table->integer('pacage_size')->nullable();
            $table->string('payment_status', 255)->nullable();
            $table->string('payment_mode', 255)->nullable();
            $table->string('payment_gatway_provider', 255)->nullable();
            $table->text('response_payment')->nullable();
            $table->integer('status')->nullable()->default(1)->comment('(0->Inactive, 1-Active)');
            $table->integer('order_type')->nullable()->default(1)->comment('(1->online, 2-offline)');
            $table->integer('footage_tier')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->string('rozor_pay_id', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_user_package');
    }
}
