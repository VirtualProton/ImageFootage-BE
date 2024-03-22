<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThirdPartyDataCountToTrendingKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trending_words', function (Blueprint $table) {
            $table->integer('total_records')->default(0);
            $table->integer('total_fetched')->default(0);
            $table->integer('total_run_remain')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trending_words', function (Blueprint $table) {
            $table->dropColumn('total_records');
            $table->dropColumn('total_fetched');
            $table->dropColumn('total_run_remain');
        });
    }
}
