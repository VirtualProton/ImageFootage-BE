<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultFilterTypeColumnToImagefootageFilters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_filters', function (Blueprint $table) {
            $table->integer('default_filter_type')->nullable()->default(0)->comment('1->default filter,0->not default');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagefootage_filters', function (Blueprint $table) {
            $table->dropColumn('default_filter_type');
        });
    }
}
