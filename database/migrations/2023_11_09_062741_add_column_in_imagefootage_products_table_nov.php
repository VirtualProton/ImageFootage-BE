<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInImagefootageProductsTableNov extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumns('imagefootage_products',['is_premium'])){
            Schema::table('imagefootage_products', function (Blueprint $table) {
                $table->enum('is_premium',[0,1])->default(0)->comment('1=>for premium product, 0=>regular product');
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
            $table->dropColumn('is_premium');
        });
    }
}
