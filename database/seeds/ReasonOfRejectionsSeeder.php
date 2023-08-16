<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ReasonOfRejectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $sql = file_get_contents(resource_path('seeder_db/reason_of_rejections_import.sql'));

            if (empty(DB::table('reason_of_rejections')->count())) {
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
