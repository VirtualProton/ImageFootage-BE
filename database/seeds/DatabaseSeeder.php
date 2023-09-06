<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrySeeder::class,
            StatSeeder::class,
            CitySeeder::class,
            ImagefootageDepartmentsSeeder::class,
            ImagefootageAdminSeeder::class,
            CurrencyConvertesSeeder::class,
            ImagefootageAccountsSeeder::class,
            ImageFootageApiSeeder::class,
            ImagefootageModulesSeeder::class,
            ImagefootagePackagesSeeder::class,
            ContentsSeeder::class,
            ImagefootageProductLocationsSeeder::class,
            ImagefootageProductOrientationSeeder::class,
            ImagefootageProductSortTypesSeeder::class,
            RmValuesSeeder::class,
            RmHeadingFieldsSeeder::class,
            RmFiledsSeeder::class,
            ReasonOfRejectionsSeeder::class,
            NgosSeeder::class,
            RolesSeeder::class,
            ImagefootageRolesModulesMappingSeeder::class,
            EmailTemplatesSeeder::class,
            PlansSeeder::class,
            TaxesSeeder::class,
            IndustryTypesSeeder::class,
        ]);
    }
}
