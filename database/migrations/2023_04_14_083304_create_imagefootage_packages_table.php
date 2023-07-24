<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootagePackagesTable extends Migration
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
            $table->timestamps();
            $table->string('package_plan', 225)->nullable();
            $table->integer('package_permonth_download')->nullable();
            $table->string('package_pcarry_forward', 225)->nullable();
            $table->string('package_expiry_yearly', 225)->nullable();
            $table->integer('pacage_size')->nullable()->default(0)->comment('0->all,1->HD,2->4k');
            $table->integer('footage_tier')->nullable()->comment('1->Commercial,2-> Non Commercial,3->Web,4->Full RF Licence');
            $table->tinyInteger('home_view')->default(1);
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
