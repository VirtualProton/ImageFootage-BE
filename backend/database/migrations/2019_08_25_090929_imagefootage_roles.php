<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImagefootageRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('role')->nullable(false);
            $table->enum('status', ['A', 'I'])->default("A")->comment('1=>Active,0=>Inactiive');
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
        Schema::dropIfExists('imagefootage_roles');
    }
}
