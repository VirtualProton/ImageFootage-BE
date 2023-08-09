<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencyConvertesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currency_convertes')->insert([
            [
                'name' => 'INR',
                'cur_value' => '1',
                'markup' => 0
            ],
            [
                'name' => 'USD',
                'cur_value' => '70.52',
                'markup' => 0
            ],
            [
                'name' => 'EURO',
                'cur_value' => '78.76',
                'markup' => 0
            ]
        ]);
    }
}
