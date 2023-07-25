<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagefootageContributorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_contributor', function (Blueprint $table) {
            $table->bigIncrements('contributor_id');
            $table->string('contributor_memberid')->nullable();
            $table->string('contributor_name')->nullable();
            $table->string('contributor_email')->nullable();
            $table->string('contributor_otp', 225)->nullable();
            $table->string('contributor_password')->nullable();
            $table->string('contributor_idproof', 225)->nullable();
            $table->enum('contributor_type', ['Donor', 'For Sale'])->default('For Sale');
            $table->dateTime('contributor_last_login')->nullable();
            $table->dateTime('contributor_added_on')->nullable();
            $table->enum('contributor_status', ['Active', 'Inactive'])->default('Inactive');
            $table->timestamps();
            $table->string('contributor_addedby', 225)->nullable();
            $table->string('contributor_accountholder', 300)->nullable();
            $table->string('contributor_banknumber', 300)->nullable();
            $table->string('contributor_ifsc', 300)->nullable();
            $table->string('contributor_bank', 300)->nullable();
            $table->string('contributor_mobile', 250)->nullable();
            $table->string('email_verification', 255)->nullable();
            $table->integer('is_mobile_verified')->nullable()->default(0);
            $table->integer('is_email_verified')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_contributor');
    }
}
