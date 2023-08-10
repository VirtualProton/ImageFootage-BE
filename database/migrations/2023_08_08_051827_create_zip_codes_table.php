<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZipCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zip_codes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('zip_code', 5)->index('zip_code');
            $table->float('lat', 10, 0);
            $table->float('lon', 10, 0);
            $table->string('city', 100)->index('city');
            $table->string('state_prefix', 100);
            $table->string('county', 100);
            $table->string('z_type', 100);
            $table->float('xaxis', 10, 0);
            $table->float('yaxis', 10, 0);
            $table->float('zaxis', 10, 0);
            $table->string('z_primary', 100);
            $table->string('country', 100)->index('country');
            $table->string('state_name', 255)->comment('US State Name');

            $table->index(['state_prefix', 'state_name'], 'state_prefix');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zip_codes');
    }
}
