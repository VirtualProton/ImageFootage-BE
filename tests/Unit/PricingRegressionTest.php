<?php
namespace Tests\Unit;

use App\Models\PromoCode;
use Tests\Support\Fixtures;
use Tests\TestCase;

class PricingRegressionTest extends TestCase
{
    /** @dataProvider subtotalCases */
    public function testObservedSubtotalSelection(array $data, $expected)
    {
        $actual = Fixtures::invoke(Fixtures::common(), 'getInvoiceSubtotalFromRequest', [$data]);
        $this->assertSame($expected, Fixtures::money($actual));
    }

    public function subtotalCases()
    {
        return [
            'items take precedence' => [['products' => ['product' => [['price' => '10.10'], ['price' => '20.20']]], 'total' => 999], '30.30'],
            'subscription' => [['subscription_subtotal' => '100.125'], '100.13'],
            'total minus tax' => [['total' => '118.00', 'tax' => '18.00'], '100.00'],
            'zero default' => [[], '0.00'],
            'clamp inferred negative' => [['total' => '5', 'tax' => '10'], '0.00'],
            'observed quantity ignored' => [['products' => ['product' => [['price' => '10', 'quantity' => 3]]]], '10.00'],
        ];
    }

    /** @dataProvider discountCases */
    public function testDiscountClampsAndRounds($type, $discount, $subtotal, $expected)
    {
        $promo = new PromoCode(['type' => $type, 'discount' => $discount]);
        $actual = Fixtures::invoke(Fixtures::common(), 'calculatePromoDiscountAmount', [$promo, $subtotal]);
        $this->assertSame($expected, Fixtures::money($actual));
    }

    public function discountCases()
    {
        return [
            ['flat', 10, 100, '10.00'], ['percentage', 10, 199.99, '20.00'],
            ['flat', 500, 100, '100.00'], ['flat', -5, 100, '0.00'],
            ['percentage', 150, 100, '100.00'], ['percentage', 10, 0, '0.00'],
            ['flat', 0.005, 100, '0.01'], ['flat', 1, -10, '0.00'],
        ];
    }

    /** @dataProvider taxCases */
    public function testRecalculationAgainstExplicitSyntheticGstExamples(array $data, $subtotal, $discount, $tax, $total)
    {
        // Synthetic 18% test policy; not a certification of jurisdictional tax rules.
        Fixtures::invoke(Fixtures::common(), 'recalculateInvoiceAmounts', [&$data, $subtotal, $discount]);
        $this->assertSame($tax, Fixtures::money($data['tax']));
        $this->assertSame($total, Fixtures::money($data['total']));
    }

    public function taxCases()
    {
        return [
            [['GSTS' => true], 100, 10, '16.20', '106.20'],
            [['GSTS' => false, 'tax' => 18], 100, 10, '0.00', '90.00'],
            [['GST' => true], 100, 0, '18.00', '118.00'],
            [['tax' => 1], 0.05, 0, '0.01', '0.06'],
            [[], 100, 0, '0.00', '100.00'],
            [['GSTS' => true], 100, 200, '0.00', '0.00'],
            [['GSTS' => true], 0, 0, '0.00', '0.00'],
            [['GSTS' => true], 199.99, 20, '32.40', '212.39'],
        ];
    }

    public function testAbsentPromoHasNoDiscount()
    {
        $this->assertSame(0.0, Fixtures::invoke(Fixtures::common(), 'calculatePromoDiscountAmount', [null, 100]));
    }
}
