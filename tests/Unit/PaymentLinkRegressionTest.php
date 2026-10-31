<?php
namespace Tests\Unit;

use Carbon\Carbon;
use Tests\Support\Fixtures;
use Tests\Support\GatewayTransport;
use Tests\TestCase;

class PaymentLinkRegressionTest extends TestCase
{
    /** @dataProvider amounts */
    public function testPaymentLinkPaiseCurrencyAndNotificationPayload($amount, $paise)
    {
        GatewayTransport::respond('POST', '/v1/payment_links', ['id' => 'plink_phase2', 'short_url' => 'http://phase2.invalid/pay', 'status' => 'created']);
        $result = Fixtures::invoke(Fixtures::common(), 'createRazorpayPaymentLink', [$amount, 'Synthetic quotation', 'QTN-7000001', 'Synthetic', 'synthetic@example.invalid', '0000000000', 'INR']);
        $request = GatewayTransport::$requests[0];
        $data = $request['data'];
        if (!is_array($data)) {
            $decoded = json_decode($data, true);
            if (is_array($decoded)) {
                $data = $decoded;
            } else {
                parse_str($data, $data);
            }
        }
        $this->assertSame($paise, (int) $data['amount']);
        $this->assertSame('INR', $data['currency']);
        $this->assertFalse(filter_var($data['notify']['sms'], FILTER_VALIDATE_BOOLEAN));
        $this->assertFalse(filter_var($data['notify']['email'], FILTER_VALIDATE_BOOLEAN));
        $this->assertSame('http://phase2.invalid/api/razorpayInvoiceResponse', $data['callback_url']);
        $this->assertSame('plink_phase2', $result['payment_link_id']);
        $this->assertSame('http://phase2.invalid/pay', $result['payment_link_url']);
    }

    public function amounts()
    {
        return [['118.00', 11800], ['0.01', 1], ['10.125', 1013], ['999999.99', 99999999]];
    }

    /** @dataProvider zeroAmounts */
    public function testNonPositiveLinkAmountsNeverCallGateway($amount)
    {
        $this->assertNull(Fixtures::invoke(Fixtures::common(), 'createRazorpayPaymentLink', [$amount, '', '', '', '', '']));
        $this->assertSame([], GatewayTransport::$requests);
    }

    public function zeroAmounts() { return [[0], [-1], ['0.001']]; }

    /** @dataProvider expiries */
    public function testLinkExpiryBoundaries($value, $expected)
    {
        $actual = Fixtures::invoke(Fixtures::common(), 'normalizeRazorpayPaymentLinkExpiryTimestamp', [$value]);
        $this->assertSame($expected === null ? null : Carbon::parse($expected, 'UTC')->timestamp, $actual);
    }

    public function expiries()
    {
        return [[null, null], ['not-a-date', null], ['2026-10-29 12:00:00', null],
            ['2026-10-28', null], ['2026-10-30', '2026-10-29 18:30:00+00:00'], ['2028-01-01', '2027-04-29 12:00:00']];
    }
}
