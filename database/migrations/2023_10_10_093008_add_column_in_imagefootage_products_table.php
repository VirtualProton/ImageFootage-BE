<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInImagefootageProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumns('imagefootage_products',['slug'])){
            Schema::table('imagefootage_products', function (Blueprint $table) {
                $table->longText('slug')->nullable();
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
            $table->dropColumn('slug');
        });
    }
}
