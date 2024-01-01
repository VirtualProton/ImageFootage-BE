<?php

use App\Models\LicenceType;
use Illuminate\Database\Seeder;

class LicenceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $sql = file_get_contents(resource_path('seeder_db/licence_type.sql'));

            $total = LicenceType::all();
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
