<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_user_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_type');
            $table->enum('status', ['A', 'I'])->default('A')->comment('1=>Active,0=>Inactiive');
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
        Schema::dropIfExists('imagefootage_user_types');
    }
}
