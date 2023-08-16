<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageModulesOld20082020Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_modules_old20082020', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('module_name');
            $table->string('url', 200)->nullable();
            $table->integer('parent_module_id');
            $table->enum('status', ['A', 'I'])->default('A')->comment('1=>Active,0=>Inactiive');
            $table->integer('sort_order')->nullable();
            $table->timestamps();
            $table->string('module_icon', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_modules_old20082020');
    }
}
