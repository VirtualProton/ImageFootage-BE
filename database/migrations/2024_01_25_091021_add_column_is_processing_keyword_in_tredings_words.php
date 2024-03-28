<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnIsProcessingKeywordInTredingsWords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumns('trending_words',['is_processing_keyword'])){
            Schema::table('trending_words', function (Blueprint $table) {
                $table->tinyInteger('is_processing_keyword')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tredings_words', function (Blueprint $table) {
            $table->dropColumn('is_processing_keyword');
        });
    }
}
