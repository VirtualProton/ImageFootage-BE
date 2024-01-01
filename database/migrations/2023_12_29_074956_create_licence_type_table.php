<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenceTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licence_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('licence_name');
            $table->text('description')->nullable();
            $table->string('product_type')->comment('1=>Image,2=>Footage,3=>Music');
            $table->string('version')->nullable();
            $table->string('slug');
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
        Schema::dropIfExists('licence_type');
    }
}
