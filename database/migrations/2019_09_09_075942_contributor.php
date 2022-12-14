<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contributor extends Migration
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
			$table->string('contributor_otp')->nullable();
			$table->string('contributor_password')->nullable();
			$table->string('contributor_idproof')->nullable();
			$table->enum('contributor_type', ['Donor', 'For Sale'])->default('For Sale');
			$table->dateTime('contributor_last_login')->nullable();
			$table->dateTime('contributor_added_on')->nullable();
			$table->enum('contributor_status', ['Active', 'Inactive'])->default('Inactive');
			$table->string('contributor_addedby')->nullable();
			$table->string('contributor_accountholder')->nullable();
			$table->string('contributor_banknumber')->nullable();
			$table->string('contributor_ifsc')->nullable();
			$table->string('contributor_bank')->nullable();
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
     Schema::dropIfExists('imagefootage_contributor');
    }
}
