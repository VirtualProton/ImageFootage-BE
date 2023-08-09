<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageAdminusersOldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_adminusers_old', function (Blueprint $table) {
            $table->bigIncrements('admin_id');
            $table->string('admin_name', 255)->nullable();
            $table->string('admin_password', 255)->nullable();
            $table->string('admin_email', 255)->nullable();
            $table->string('admin_mobile', 255)->nullable();
            $table->string('admin_address', 255)->nullable();
            $table->dateTime('admin_created_at')->nullable();
            $table->dateTime('admin_lastlogin')->nullable();
            $table->enum('admin_type', ['Super', 'Sub', 'Agent'])->default('Agent');
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
        Schema::dropIfExists('imagefootage_adminusers_old');
    }
}
