<?php

namespace App\Services\Sms\Providers;

use App\Services\Sms\Contracts\SmsInterface;
use Illuminate\Support\Facades\Log;

class Msg91SmsProvider implements SmsInterface
{
    protected $authKey;
    protected $senderId;
    protected $route;
    protected $baseUrl;

    public function __construct()
    {
        $this->authKey = config('services.msg91.auth_key');
        $this->senderId = config('services.msg91.sender_id');
        $this->route = config('services.msg91.route', '4');
        $this->baseUrl = 'https://control.msg91.com/api';
    }

    /**
     * Send SMS using MSG91
     */
    public function sendSms(string $message, string $mobile, ?string $templateId = null): array
    {
        try {
            $mobile = preg_replace('/^\+?91/', '', $mobile);

            $params = [
                'authkey' => $this->authKey,
                'mobiles' => $mobile,
                'message' => urlencode($message),
                'sender' => $this->senderId,
                'route' => $this->route,
                'country' => '91',
            ];

            if ($templateId) {
                $params['DLT_TE_ID'] = $templateId;
            }

            $url = 'https://api.msg91.com/api/sendhttp.php?' . http_build_query($params);

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            Log::info('MSG91 SMS Response', [
                'mobile' => $mobile,
                'status' => $httpCode,
                'body' => $response,
                'error' => $err
            ]);

            if ($err) {
                return [
                    'success' => false,
                    'message' => 'cURL Error while sending SMS',
                    'error' => $err
                ];
            }

            if ($httpCode >= 200 && $httpCode < 300) {
                return [
                    'success' => true,
                    'message' => 'SMS sent successfully',
                    'response' => json_decode($response, true)
                ];
            }

            return [
                'success' => false,
                'message' => 'Failed to send SMS',
                'error' => $response
            ];
        } catch (\Exception $e) {
            Log::error('MSG91 SMS Error', [
                'mobile' => $mobile,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Exception occurred while sending SMS',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Send OTP using MSG91 v5 API
     * MSG91 generates and sends OTP automatically
     * 
     * @param string $mobile
     * @param string $templateId
     * @return array
     */
    public function sendOtp(string $mobile, string $templateId): array
    {
        try {
            $mobile = preg_replace('/^\+?91/', '', $mobile);
            Log::info('MSG91 OTP Trigger', [
                'mobile' => $mobile,
                'template_id' => $templateId,
                'authkey' => $this->authKey
            ]);

            // Prepare query parameters
            $queryParams = [
                'template_id' => $templateId,
                'mobile' => '91' . $mobile,
                'authkey' => $this->authKey,
                'otp_expiry' => config('services.msg91.otp_expiry', '10'),
                'realTimeResponse' => '1'
            ];

            // Build URL with query parameters
            $url = $this->baseUrl . '/v5/otp?' . http_build_query($queryParams);

            // Optional: Send additional template variables if your template needs them
            $postData = json_encode([
                // 'Param1' => 'value1',
                // 'Param2' => 'value2',
            ]);

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $postData,
                CURLOPT_SSL_VERIFYPEER => false, // Add this to disable SSL verification (for development)
                CURLOPT_SSL_VERIFYHOST => false, // Add this as well
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json",
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            Log::info('MSG91 OTP Trigger Response', [
                'mobile' => $mobile,
                'template_id' => $templateId,
                'status' => $httpCode,
                'body' => $response,
                'error' => $err
            ]);

            if ($err) {
                return [
                    'success' => false,
                    'message' => 'cURL Error while sending OTP',
                    'error' => $err
                ];
            }

            $responseData = json_decode($response, true);
            if ($httpCode >= 200 && $httpCode < 300 && isset($responseData['type']) && $responseData['type'] === 'success') {
                return [
                    'success' => true,
                    'message' => 'OTP sent successfully by MSG91',
                    'response' => $responseData,
                    'request_id' => $responseData['request_id'] ?? null,
                ];
            }

            return [
                'success' => false,
                'message' => 'Failed to send OTP',
                'error' => $response
            ];
        } catch (\Exception $e) {
            Log::error('MSG91 OTP Trigger Error', [
                'mobile' => $mobile,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Exception occurred while triggering OTP',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Verify OTP sent by MSG91
     * 
     * @param string $mobile
     * @param string $otp
     * @return array
     */
    public function verifyOtp(string $mobile, string $otp): array
    {
        try {
            $responseData = [
                'type' => 'success',
                'message' => 'OTP verified successfully'
            ];
            return [
                'success' => false,
                'message' => $responseData['message'] ?? 'Invalid OTP',
                'error' => 'could not process request'
            ];
            $mobile = preg_replace('/^\+?91/', '', $mobile);

            $queryParams = [
                'authkey' => $this->authKey,
                'mobile' => '91' . $mobile,
                'otp' => $otp
            ];

            $url = $this->baseUrl . '/v5/otp/verify?' . http_build_query($queryParams);

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET"
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            Log::info('MSG91 OTP Verification Response', [
                'mobile' => $mobile,
                'status' => $httpCode,
                'body' => $response,
                'error' => $err
            ]);

            if ($err) {
                return [
                    'success' => false,
                    'message' => 'cURL Error while verifying OTP',
                    'error' => $err
                ];
            }

            $responseData = json_decode($response, true);
            if (!is_array($responseData)) {
                return [
                    'success' => false,
                    'message' => 'Invalid response from SMS provider',
                    'error' => $response
                ];
            }
            if ($httpCode >= 200 && $httpCode < 300 && isset($responseData['type']) && $responseData['type'] === 'success') {
                return [
                    'success' => true,
                    'message' => 'OTP verified successfully',
                    'response' => $responseData
                ];
            }

            return [
                'success' => false,
                'message' => $responseData['message'] ?? 'Invalid OTP',
                'error' => $response
            ];
        } catch (\Exception $e) {
            Log::error('MSG91 OTP Verification Error', [
                'mobile' => $mobile,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Exception occurred while verifying OTP',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Resend OTP
     * 
     * @param string $mobile
     * @param string $retryType (text|voice)
     * @return array
     */
    public function resendOtp(string $mobile, string $retryType = 'text'): array
    {
        try {
            $mobile = preg_replace('/^\+?91/', '', $mobile);

            $queryParams = [
                'authkey' => $this->authKey,
                'mobile' => '91' . $mobile,
                'retrytype' => $retryType
            ];

            $url = $this->baseUrl . '/v5/otp/retry?' . http_build_query($queryParams);

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            Log::info('MSG91 OTP Resend Response', [
                'mobile' => $mobile,
                'retry_type' => $retryType,
                'status' => $httpCode,
                'body' => $response,
                'error' => $err
            ]);

            if ($err) {
                return [
                    'success' => false,
                    'message' => 'cURL Error while resending OTP',
                    'error' => $err
                ];
            }

            if ($httpCode >= 200 && $httpCode < 300) {
                return [
                    'success' => true,
                    'message' => 'OTP resent successfully',
                    'response' => json_decode($response, true)
                ];
            }

            return [
                'success' => false,
                'message' => 'Failed to resend OTP',
                'error' => $response
            ];
        } catch (\Exception $e) {
            Log::error('MSG91 OTP Resend Error', [
                'mobile' => $mobile,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Exception occurred while resending OTP',
                'error' => $e->getMessage()
            ];
        }
    }
}
