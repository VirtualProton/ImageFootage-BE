<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdatePageContentColumnToImagefootageStaticpagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_staticpages', function (Blueprint $table) {
            //TODO: Doctrine installation pending
            // Schema::getConnection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
            // $table->text('page_content')->change();
            DB::statement('ALTER TABLE `imagefootage_staticpages` CHANGE `page_content` `page_content` TEXT NULL DEFAULT NULL;');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagefootage_staticpages', function (Blueprint $table) {
            // $table->string('page_content')->change();
            DB::statement('ALTER TABLE `imagefootage_staticpages` CHANGE `page_content` `page_content` VARCHAR(255) NULL DEFAULT NULL;');
        });
    }
}
