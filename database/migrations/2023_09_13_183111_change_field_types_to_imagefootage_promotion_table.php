<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeFieldTypesToImagefootagePromotionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_promotion', function (Blueprint $table) {
            DB::statement('ALTER TABLE `imagefootage_promotion` CHANGE `date_start` `date_start` DATE NULL DEFAULT NULL, CHANGE `date_end` `date_end` DATE NULL DEFAULT NULL;');
            DB::statement('ALTER TABLE `imagefootage_promotion` CHANGE `id` `id` INT NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`);');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagefootage_promotion', function (Blueprint $table) {
            //
        });
    }
}
