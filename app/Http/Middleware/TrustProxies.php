<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * For AWS EC2 + Coolify (Traefik in Docker), requests will come
     * from private Docker / internal networks. We trust those so
     * Laravel can correctly use X-Forwarded-Proto / Host.
     *
     * @var array|string|null
     */
    protected $proxies = [
        '10.0.0.0/8',
        '172.16.0.0/12',
        '192.168.0.0/16',
    ];
    // If you ever want "just make it work" mode, you can switch to:
    // protected $proxies = '*';

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
