<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMusicColumnsToImagefootageProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagefootage_products', function (Blueprint $table) {
            $table->string('music_sound_bpm')->after('thumb_update_status')->nullable();
            $table->string('music_duration')->after('music_sound_bpm')->nullable();
            $table->string('music_fileType')->after('music_duration')->nullable();
            $table->decimal('music_price', 10, 2)->after('music_fileType')->nullable();
            $table->string('music_size')->after('music_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagefootage_products', function (Blueprint $table) {
            $table->dropColumn('music_sound_bpm');
            $table->dropColumn('music_duration');
            $table->dropColumn('music_fileType');
            $table->dropColumn('music_price');
            $table->dropColumn('music_size');
        });
    }
}
