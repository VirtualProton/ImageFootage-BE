<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImgfAdminusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imgf_adminusers', function (Blueprint $table) {
            $table->bigIncrements('admin_id');
            $table->string('admin_name')->nullable();
            $table->string('admin_password')->nullable();
            $table->string('admin_email')->nullable();
            $table->string('admin_mobile')->nullable();
            $table->string('admin_address')->nullable();
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
        Schema::dropIfExists('imgf_adminusers');
    }
}
