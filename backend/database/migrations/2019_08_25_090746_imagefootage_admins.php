<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImagefootageAdmins extends Migration
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
			$table->string('password')->nullable(false);
			$table->string('email')->nullable(false);
			$table->string('mobile')->nullable();
			$table->string('address')->nullable();
            $table->dateTime('lastlogin')->nullable();
            $table->integer('department_id');
            $table->integer('role_id');
            $table->enum('admin_status', ['Active', 'Inactive'])->default('Active');
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
        //
    }
}
