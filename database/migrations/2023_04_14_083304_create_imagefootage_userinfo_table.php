<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageUserinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_userinfo', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->string('partner', 245)->nullable();
            $table->string('whitelist', 245)->nullable();
            $table->string('blacklist', 245)->nullable();
            $table->string('frozen', 245)->nullable();
            $table->string('allow_certi', 245)->nullable();
            $table->string('enable_subs_multi', 245)->nullable();
            $table->string('preferred_contact_method', 245)->nullable();
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
        Schema::dropIfExists('imagefootage_userinfo');
    }
}
