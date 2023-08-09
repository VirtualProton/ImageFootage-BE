<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ImagefootageAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('imagefootage_admins')->insert([
            'name' => 'Super Admin',
            'password' => Hash::make('Bytes@123'),
            'email' => 'admin@imagefootage.com',
            'department_id' => 1,
            'role_id' => 1,
            'admin_status' => 'A',
            'country' => 101,
            'state' => 36,
        ]);
    }
}
