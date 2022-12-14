<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Packages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('imagefootage_packages', function (Blueprint $table) {
            $table->bigIncrements('package_id');
			$table->string('package_name')->nullable();
			$table->string('package_price')->nullable();
			$table->string('package_description')->nullable();
			$table->integer('package_products_count')->nullable();
			$table->string('package_type')->nullable();
			$table->dateTime('package_added_on')->nullable();
			$table->integer('package_expiry')->nullable();
			$table->string('package_addedby')->nullable();
			$table->enum('package_status', ['Active', 'Inactive'])->default('Inactive');
			$table->integer('package_permonth_download')->nullable();
			$table->string('package_pcarry_forward')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_packages');
    }
}
