<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnDefaultPromotion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement('ALTER TABLE `imagefootage_promotion` MODIFY COLUMN `product_name` VARCHAR(255) DEFAULT NULL;');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `imagefootage_promotion` MODIFY COLUMN `product_name` VARCHAR(255) NOT NULL;');
    }
}
