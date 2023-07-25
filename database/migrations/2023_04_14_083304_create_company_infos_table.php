<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_infos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title', 250)->default('');
            $table->string('address1', 250)->default('');
            $table->string('address2', 250)->default('');
            $table->string('twitter', 250)->default('');
            $table->string('facebook', 250)->default('');
            $table->string('linkedin', 250)->default('');
            $table->string('youtube', 250)->default('');
            $table->string('pinterest', 250)->nullable();
            $table->string('googleplus', 250)->default('');
            $table->string('fax', 250)->default('');
            $table->string('contact', 250)->default('');
            $table->string('landline', 50);
            $table->string('contactemail', 50);
            $table->string('alternateemail', 200)->default('');
            $table->string('logo', 255);
            $table->string('icon', 255);
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
            $table->string('insta', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_infos');
    }
}
