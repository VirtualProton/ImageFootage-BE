<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddUpdateImageFilters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Disable filters where type is 'image' and value is NOT 'people_number'
        DB::table('imagefootage_filters')
            ->where('type', 'image')
            ->where('value', '!=', 'people_number')
            ->where('status', 'active')
            ->update(['status' => 'inactive']);

        // Disable associated options
        DB::table('imagefootage_filters_options')
            ->whereIn('filter_id', function ($query) {
                $query->select('id')
                      ->from('imagefootage_filters')
                      ->where('type', 'image')
                      ->where('value', '!=', 'people_number');
            })
            ->update(['status' => 'inactive']);

        DB::table('imagefootage_filters_options')
            ->whereIn('filter_id', function ($query) {
                $query->select('id')
                      ->from('imagefootage_filters')
                      ->where('type', 'image')
                      ->where('value', 'people_number');
            })
            ->whereIn('value', [4, 5])
            ->update(['status' => 'inactive']);

        DB::table('imagefootage_filters_options')
            ->whereIn('filter_id', function ($query) {
                $query->select('id')
                      ->from('imagefootage_filters')
                      ->where('type', 'image')
                      ->where('value', 'people_number');
            })
            ->where('value', 3)
            ->update(['option_name' => '3 People or more']);

        $getFilter = DB::table('imagefootage_filters')
                            ->where('type', 'image')
                            ->orderBy('sort_order', 'desc')
                            ->first();

        $sortOrder = $getFilter->sort_order + 1;

        // Insert the new 'Orientation' filter
        $filterId = DB::table('imagefootage_filters')->insertGetId([
            'name' => 'Orientation',
            'value' => 'orientation',
            'type' => 'image',
            'filter_type' => 1,
            'has_multiple_values' => 0,
            'sort_order' => $sortOrder,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
            'default_filter_type' => 1
        ]);

        // Insert filter options
        $options = [
            ['filter_id' => $filterId, 'value' => '1', 'option_name' => 'Landscape', 'sort_order' => 1 ,'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['filter_id' => $filterId, 'value' => '2', 'option_name' => 'Portrait', 'sort_order' => 2 ,'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['filter_id' => $filterId, 'value' => '3', 'option_name' => 'Square', 'sort_order' => 3 ,'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['filter_id' => $filterId, 'value' => '4', 'option_name' => 'Widescreen', 'sort_order' => 4 ,'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        ];
        
        DB::table('imagefootage_filters_options')->insert($options);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
