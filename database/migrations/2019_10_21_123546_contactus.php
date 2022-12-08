<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contactus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagefootage_usercontactus', function (Blueprint $table) {
            $table->bigIncrements('contactus_id');
			$table->string('contactus_name')->nullable();
			$table->string('contactus_mobileno')->nullable();
			$table->string('contactus_emailid')->nullable();
			$table->string('contactus_message')->nullable();
			$table->dateTime('cart_added_on')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagefootage_usercontactus');
    }
}
