<?php
namespace Tests\Support;

final class Fixtures
{
    public static function callback(array $changes = [])
    {
        $data = array_merge([
            'razorpay_payment_id' => 'pay_phase2', 'razorpay_payment_link_id' => 'plink_phase2',
            'razorpay_payment_link_reference_id' => 'QTN-7000001', 'razorpay_payment_link_status' => 'paid',
        ], $changes);
        $data['razorpay_signature'] = hash_hmac('sha256', $data['razorpay_payment_link_id'].'|'.
            $data['razorpay_payment_link_reference_id'].'|'.$data['razorpay_payment_link_status'].'|'.$data['razorpay_payment_id'],
            'phase2-synthetic-secret');
        return $data;
    }

    public static function invoke($object, $method, array $arguments = [])
    {
        $reflection = new \ReflectionMethod($object, $method);
        $reflection->setAccessible(true);
        return $reflection->invokeArgs($object, $arguments);
    }

    public static function common()
    {
        $common = new \App\Models\Common();
        $common->keyRazorId = 'rzp_test_phase2';
        $common->keyRazorSecret = 'phase2-synthetic-secret';
        return $common;
    }

    public static function money($value)
    {
        return number_format($value, 2, '.', '');
    }
}
