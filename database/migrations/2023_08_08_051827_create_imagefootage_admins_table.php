<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('password');
            $table->string('email');
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->dateTime('lastlogin')->nullable();
            $table->integer('department_id');
            $table->integer('role_id');
            $table->enum('admin_status', ['A', 'I'])->default('A');
            $table->timestamps();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_admins');
    }
}
