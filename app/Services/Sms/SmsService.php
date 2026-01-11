<?php

namespace App\Services\Sms;

use App\Services\Sms\Contracts\SmsInterface;
use App\Services\Sms\Providers\Msg91SmsProvider;
use App\Services\Sms\Providers\TnnraoSmsProvider;
use InvalidArgumentException;

class SmsService
{
    protected $provider;

    public function __construct(?string $providerName = null)
    {
        $providerName = $providerName ?? config('services.sms.provider', 'msg91');
        $this->provider = $this->createProvider($providerName);
    }

    /**
     * Create SMS provider instance
     */
    protected function createProvider(string $providerName): SmsInterface
    {
        switch (strtolower($providerName)) {
            case 'msg91':
                return new Msg91SmsProvider();
            default:
                throw new InvalidArgumentException("SMS provider '{$providerName}' is not supported.");
        }
    }

    /**
     * Send SMS
     */
    public function sendSms(string $message, string $mobile, ?string $templateId = null): array
    {
        return $this->provider->sendSms($message, $mobile, $templateId);
    }

    /**
     * Send OTP
     */
    public function sendOtp(string $mobile, string $templateId): array
    {
        return $this->provider->sendOtp($mobile, $templateId);
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(string $mobile, string $otp): array
    {
        return $this->provider->verifyOtp($mobile, $otp);
    }

    /**
     * Get current provider name
     */
    public function getProviderName(): string
    {
        return config('services.sms.provider', 'msg91');
    }
}
