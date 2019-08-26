<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImagefootageDepartments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('department')->nullable(false);
            $table->enum('status', ['A', 'I'])->default("A")->comment('A=>Active,I=>Inactiive');
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
        Schema::dropIfExists('imagefootage_departments');
    }
}
