<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnViewCountInImagefootageProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumns('imagefootage_products',['view_count'])){
            Schema::table('imagefootage_products', function (Blueprint $table) {
                $table->integer('view_count')->default(0);
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
            $table->dropColumn('view_count');
        });
    }
}
