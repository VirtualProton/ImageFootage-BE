<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageDepartmentsTable extends Migration
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
            $table->string('department');
            $table->enum('status', ['A', 'I'])->default('A')->comment('A=>Active,I=>Inactiive');
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
