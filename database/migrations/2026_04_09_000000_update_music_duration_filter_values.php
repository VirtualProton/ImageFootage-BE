<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateMusicDurationFilterValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Get the duration filter ID for music type
        $durationFilter = DB::table('imagefootage_filters')
            ->where('value', 'duration')
            ->where('type', 'music')
            ->first();

        if ($durationFilter) {
            // Delete old music duration options
            DB::table('imagefootage_filters_options')
                ->where('filter_id', $durationFilter->id)
                ->delete();

            // Insert new duration options with numeric values matching footage format
            $durationOptions = [
                ['option_name' => '0-10s', 'value' => '0-10', 'sort_order' => 1],
                ['option_name' => '10-30s', 'value' => '10-30', 'sort_order' => 2],
                ['option_name' => '30-60s', 'value' => '30-60', 'sort_order' => 3],
                ['option_name' => '1-2 min', 'value' => '60-120', 'sort_order' => 4],
                ['option_name' => '2-5 min', 'value' => '120-300', 'sort_order' => 5],
                ['option_name' => '5+ min', 'value' => '300+', 'sort_order' => 6],
            ];

            foreach ($durationOptions as $option) {
                DB::table('imagefootage_filters_options')->insert([
                    'filter_id' => $durationFilter->id,
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Get the duration filter ID for music type
        $durationFilter = DB::table('imagefootage_filters')
            ->where('value', 'duration')
            ->where('type', 'music')
            ->first();

        if ($durationFilter) {
            // Delete the music duration options
            DB::table('imagefootage_filters_options')
                ->where('filter_id', $durationFilter->id)
                ->delete();

            // Restore old music duration options
            $oldDurationOptions = [
                ['option_name' => '< 1 min', 'value' => 'less_than_1min', 'sort_order' => 1],
                ['option_name' => '1 - 3 min', 'value' => '1_to_3min', 'sort_order' => 2],
                ['option_name' => '3 - 5 min', 'value' => '3_to_5min', 'sort_order' => 3],
                ['option_name' => '> 5 min', 'value' => 'more_than_5min', 'sort_order' => 4],
            ];

            foreach ($oldDurationOptions as $option) {
                DB::table('imagefootage_filters_options')->insert([
                    'filter_id' => $durationFilter->id,
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
    }
}
