<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFilterTypeColumnToImagefootageFilters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_filters', function (Blueprint $table) {
            $table->integer('filter_type')->nullable()->default(1)->comment('1->single,2->multiple')->after('type');
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
            $table->dropColumn('filter_type');
        });
    }
}
