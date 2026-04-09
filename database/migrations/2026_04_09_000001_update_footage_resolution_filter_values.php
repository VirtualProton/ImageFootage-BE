<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateFootageResolutionFilterValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Get the resolution filter ID for footage type
        $resolutionFilter = DB::table('imagefootage_filters')
            ->where('value', 'resolution')
            ->where('type', 'footage')
            ->first();

        if ($resolutionFilter) {
            // Update hd to 1080
            DB::table('imagefootage_filters_options')
                ->where('filter_id', $resolutionFilter->id)
                ->where('value', 'hd')
                ->update(['value' => '1080']);

            // Update 720p to 720
            DB::table('imagefootage_filters_options')
                ->where('filter_id', $resolutionFilter->id)
                ->where('value', '720p')
                ->update(['value' => '720']);

            DB::table('imagefootage_filters_options')
                ->where('filter_id', $resolutionFilter->id)
                ->where('value', '4k')
                ->update(['value' => '4K']);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Get the resolution filter ID for footage type
        $resolutionFilter = DB::table('imagefootage_filters')
            ->where('value', 'resolution')
            ->where('type', 'footage')
            ->first();

        if ($resolutionFilter) {
            // Revert 1080 back to hd
            DB::table('imagefootage_filters_options')
                ->where('filter_id', $resolutionFilter->id)
                ->where('value', '1080')
                ->update(['value' => 'hd']);

            // Revert 720 back to 720p
            DB::table('imagefootage_filters_options')
                ->where('filter_id', $resolutionFilter->id)
                ->where('value', '720')
                ->update(['value' => '720p']);

            // Revert 4K back to 4k
            DB::table('imagefootage_filters_options')
                ->where('filter_id', $resolutionFilter->id)
                ->where('value', '4K')
                ->update(['value' => '4k']);
        }
    }
}
