<?php
namespace Tests\Integration;

use App\Models\UserPackage;
use Tests\Support\MySqlTestCase;

class CarryForwardIntegrationTest extends MySqlTestCase
{
    public function testActualBalanceCommandCreditsSyntheticRemainderOnceOnSequentialRuns()
    {
        config(['logging.channels.carry-forward' => ['driver' => 'single', 'path' => storage_path('logs/carry-forward.log')]]);
        $expired = UserPackage::create(['user_id' => 700001, 'package_id' => 700010, 'package_name' => 'Synthetic Old Plan',
            'package_price' => '100.00', 'package_products_count' => 10, 'downloaded_product' => 3,
            'package_type' => 'Image', 'package_plan' => '1', 'package_permonth_download' => 10,
            'package_expiry_date_from_purchage' => '2026-10-28 00:00:00', 'created_at' => '2025-10-28', 'status' => 1]);
        UserPackage::create(['user_id' => 700001, 'package_id' => 700010, 'package_name' => 'Synthetic Renewal',
            'package_products_count' => 10, 'downloaded_product' => 0, 'package_type' => 'Image', 'package_plan' => '1',
            'created_at' => '2026-10-29 00:00:00', 'package_expiry_date_from_purchage' => '2027-10-29', 'status' => 1]);
        $command = new \App\Console\Commands\CreateEntryForCarryForwardBalance();
        $command->handle();
        $credited = UserPackage::where('order_type', 3)->firstOrFail();
        $this->assertSame(7, (int) $credited->package_products_count);
        $this->assertSame('2027-10-28 00:00:00', $credited->package_expiry_date_from_purchage);
        $this->assertSame(0, (int) UserPackage::findOrFail($expired->id)->status);
        $command->handle();
        $this->assertSame(1, UserPackage::where('order_type', 3)->count());
        // Observed synthetic policy; business approval of annual/date/credit rules remains pending.
    }
}
