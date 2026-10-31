<?php
namespace Tests\Support;

// Real Razorpay SDK/signature code, deterministic in-memory Requests transport. Never a socket.
class GatewayTransport implements \WpOrg\Requests\Transport
{
    public static $responses = [];
    public static $requests = [];

    public static function install()
    {
        $property = new \ReflectionProperty(\WpOrg\Requests\Requests::class, 'transports');
        $property->setAccessible(true);
        $property->setValue(null, [self::class => self::class]);
        \WpOrg\Requests\Requests::$transport = [];
        self::$responses = self::$requests = [];
    }

    public static function respond($method, $path, array $body, $status = 200)
    {
        self::$responses[] = compact('method', 'path', 'body', 'status');
    }

    public function request($url, $headers = [], $data = [], $options = [])
    {
        $expected = array_shift(self::$responses);
        $actual = ['method' => $options['type'], 'path' => parse_url($url, PHP_URL_PATH), 'data' => $data];
        self::$requests[] = $actual;
        if (!$expected || strtoupper($actual['method']) !== $expected['method'] || rtrim($actual['path'], '/') !== rtrim($expected['path'], '/')) {
            throw new \RuntimeException('Unexpected gateway operation refused by test transport.');
        }
        return 'HTTP/1.1 '.$expected['status']." Test\r\nContent-Type: application/json\r\n\r\n".json_encode($expected['body']);
    }

    public function request_multiple($requests, $options)
    {
        throw new \RuntimeException('Concurrent external requests are forbidden.');
    }

    public static function test($capabilities = [])
    {
        return true;
    }
}
