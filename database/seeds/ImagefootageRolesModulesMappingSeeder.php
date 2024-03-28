<?php

use App\Models\RolesModulesMapping;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ImagefootageRolesModulesMappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $sql = file_get_contents(resource_path('seeder_db/imagefootage_roles_modules_mapping_import.sql'));

            $total = RolesModulesMapping::all();
            if ($total->count() == 0) {
                DB::unprepared($sql);
            }
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
