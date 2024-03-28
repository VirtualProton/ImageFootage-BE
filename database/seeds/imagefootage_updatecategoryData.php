<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class imagefootage_updatecategoryData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getAllData =  DB::table("imagefootage_productcategory")->get();
        foreach ($getAllData as $key => $value) {
            DB::table('imagefootage_productcategory')->insert([
                'category_name' => $value->category_name,
                'category_order'=> $value->category_order,
                'category_added_by' => $value->category_added_by,
                'is_display_home' => $value->is_display_home,
                'category_status' => $value->category_status,
                'category_added_on' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'category_keywords' => $value->category_keywords,
                'product_id' => $value->product_id,
                'image_path' => $value->image_path,
                'category_slug' => $value->category_slug,
                'type'=>2
            ]);
            DB::table('imagefootage_productcategory')->insert([
                'category_name' => $value->category_name,
                'category_order'=> $value->category_order,
                'category_added_by' => $value->category_added_by,
                'is_display_home' => $value->is_display_home,
                'category_status' => $value->category_status,
                'category_added_on' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'category_keywords' => $value->category_keywords,
                'product_id' => $value->product_id,
                'image_path' => $value->image_path,
                'category_slug' => $value->category_slug,
                'type'=>3
            ]);
        }
    }
}
