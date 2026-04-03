<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddDurationFilterForFootageType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Insert the Duration filter
        $filterId = DB::table('imagefootage_filters')->insertGetId([
            'name' => 'Duration',
            'value' => 'duration',
            'type' => 'footage',
            'filter_type' => 2, // multiple options
            'default_filter_type' => 0, // not default
            'has_multiple_values' => 0,
            'sort_order' => 10,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert duration options
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Delete the duration filter and its options (cascade)
        DB::table('imagefootage_filters')->where('value', 'duration')->where('type', 'footage')->delete();
    }
}
