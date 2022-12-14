<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImagefootageModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('module_name')->nullable(false);
            $table->integer('parent_module_id');
            $table->enum('status',['A', 'I'])->default("A")->comment('1=>Active,0=>Inactiive');
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
        Schema::dropIfExists('imagefootage_modules');
    }
}
