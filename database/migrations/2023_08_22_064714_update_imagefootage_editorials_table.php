<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateImagefootageEditorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table->string('title')->nullable()->default(null)->change();
        $table->string('search_term')->nullable()->default(null)->change();
        $table->string('main_image_id')->nullable()->default(null)->change();
        $table->tinyInteger('status')->default(0)->change();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->enum('status', ['active', 'inactive'])->default('active')->change();
    }
}
