<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddResolutionFilter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Insert the Resolution filter for footage type
        $filterId = DB::table('imagefootage_filters')->insertGetId([
            'name' => 'Resolution',
            'value' => 'resolution',
            'type' => 'footage',
            'filter_type' => 2,
            'default_filter_type' => 0,
            'has_multiple_values' => 0,
            'sort_order' => 11,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert resolution options
        $resolutionOptions = [
            ['option_name' => '4K', 'value' => '4k', 'sort_order' => 1],
            ['option_name' => 'HD (1920x1080)', 'value' => 'hd', 'sort_order' => 2],
            ['option_name' => '720p', 'value' => '720p', 'sort_order' => 3],
        ];

        foreach ($resolutionOptions as $option) {
            DB::table('imagefootage_filters_options')->insert([
                'filter_id' => $filterId,
                'option_name' => $option['option_name'],
                'value' => $option['value'],
                'sort_order' => $option['sort_order'],
                'status' => 'active',
                'is_group_value' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insert the Artist Name filter for music type
        $artistFilterId = DB::table('imagefootage_filters')->insertGetId([
            'name' => 'Artist Name',
            'value' => 'artist_name',
            'type' => 'music',
            'filter_type' => 2,
            'default_filter_type' => 0,
            'has_multiple_values' => 0,
            'sort_order' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert the Duration filter for music type
        $durationFilterId = DB::table('imagefootage_filters')->insertGetId([
            'name' => 'Duration',
            'value' => 'duration',
            'type' => 'music',
            'filter_type' => 2,
            'default_filter_type' => 0,
            'has_multiple_values' => 0,
            'sort_order' => 2,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert duration options
        $durationOptions = [
            ['option_name' => '< 1 min', 'value' => 'less_than_1min', 'sort_order' => 1],
            ['option_name' => '1 - 3 min', 'value' => '1_to_3min', 'sort_order' => 2],
            ['option_name' => '3 - 5 min', 'value' => '3_to_5min', 'sort_order' => 3],
            ['option_name' => '> 5 min', 'value' => 'more_than_5min', 'sort_order' => 4],
        ];

        foreach ($durationOptions as $option) {
            DB::table('imagefootage_filters_options')->insert([
                'filter_id' => $durationFilterId,
                'option_name' => $option['option_name'],
                'value' => $option['value'],
                'sort_order' => $option['sort_order'],
                'status' => 'active',
                'is_group_value' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('imagefootage_filters')->where('value', 'resolution')->where('type', 'footage')->delete();
        DB::table('imagefootage_filters')->where('value', 'artist_name')->where('type', 'music')->delete();
        DB::table('imagefootage_filters')->where('value', 'duration')->where('type', 'music')->delete();
    }
}
