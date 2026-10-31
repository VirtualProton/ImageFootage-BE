<?php
namespace Tests\Unit;

use App\Models\Invoice;
use App\Models\UserPackage;
use Tests\TestCase;

class InvoiceDatesRegressionTest extends TestCase
{
    /** @dataProvider quotationDates */
    public function testObservedQuotationDateDisplay($created, $modified, $type, $expected)
    {
        $this->assertSame($expected, Invoice::resolveQuotationDateDisplayValue($created, $modified, $type));
    }

    public function quotationDates()
    {
        return [
            [null, '2026-10-28 14:00:00', 3, '2026-10-28 14:00:00'],
            ['2026-10-01', '2026-10-28 14:00:00', 3, '2026-10-28 14:00:00'],
            ['2026-10-01 00:00:00', '2026-10-28 14:00:00', '3', '2026-10-28 14:00:00'],
            ['2026-10-01 10:00:00', '2026-10-28 14:00:00', 3, '2026-10-01 10:00:00'],
            ['2026-10-01', '2026-10-28', 1, '2026-10-01'],
            [' 2026-10-01 ', null, 3, '2026-10-01'],
        ];
    }

    /** @dataProvider packageDates */
    public function testObservedPackageExpiryUsesExtendedValueFirst($base, $extended, $expected)
    {
        $package = new UserPackage();
        $package->setRawAttributes(['package_expiry_date_from_purchage' => $base, 'package_extended_expiry_data' => $extended]);
        $date = $package->resolveEffectiveExpiryDate();
        $this->assertSame($expected, $date ? $date->format('Y-m-d') : null);
    }

    public function packageDates()
    {
        return [
            ['2026-10-29', null, '2026-10-29'],
            ['2026-10-29', '2026-11-15', '2026-11-15'],
            ['2026-10-29', 'not-a-date', null],
            [null, null, null],
        ];
    }
}
