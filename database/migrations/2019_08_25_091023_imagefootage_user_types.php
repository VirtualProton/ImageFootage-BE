<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImagefootageUserTypes extends Migration
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
            $table->string('user_type')->nullable(false);
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
        Schema::dropIfExists('imagefootage_user_types');
    }
}
