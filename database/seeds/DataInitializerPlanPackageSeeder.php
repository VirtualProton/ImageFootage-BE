<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\ProductCategory;

class DataInitializerPlanPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $sql = file_get_contents(resource_path('seeder_db/imagefootage_packages.sql'));
            DB::unprepared($sql);
        } catch (\Exception $e) {
            Log::error('--------something went wrong with data insert----------', [
                'Message' => $e->getMessage(),
                'Line' => $e->getLine(),
                'File' => $e->getFile(),
                'code' => $e->getCode(),
            ]);
        }
    }
}
