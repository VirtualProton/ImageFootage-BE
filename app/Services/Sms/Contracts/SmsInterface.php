<?php

namespace App\Services\Sms\Contracts;

interface SmsInterface
{
    /**
     * Send SMS message
     * 
     * @param string $message
     * @param string $mobile
     * @param string|null $templateId
     * @return array
     */
    public function sendSms(string $message, string $mobile, ?string $templateId = null): array;

    /**
     * Send OTP
     * 
     * @param string $mobile
     * @param string $templateId
     * @return array
     */
    public function sendOtp(string $mobile, string $templateId): array;

    /**
     * Verify OTP
     * 
     * @param string $mobile
     * @param string $otp
     * @return bool
     */
    public function verifyOtp(string $mobile, string $otp): array;
}
