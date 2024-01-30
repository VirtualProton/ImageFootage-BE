<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSearchTextInProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumns('imagefootage_products',['search_terms'])){
            Schema::table('imagefootage_products', function (Blueprint $table) {
                $table->text('search_terms')->nullable();
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
        Schema::table('imagefootage_products', function (Blueprint $table) {
            $table->dropColumn('search_terms');
        });
    }
}
