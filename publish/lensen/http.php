<?php

declare(strict_types=1);

use Exewen\Http\Middleware\LogMiddleware;
use Lensen\Temu\Constants\TemuEnum;
use Lensen\Temu\Middleware\AuthMiddleware;

return [
    'channels' => [
        TemuEnum::CHANNEL_API  => [
            'verify'          => false,
            'ssl'             => true,
            'host'            => 'openapi-b-eu.temu.com/openapi/router',
            'port'            => null,
            'prefix'          => null,
            'connect_timeout' => 3,
            'timeout'         => 20,
            'handler'         => [
                AuthMiddleware::class,
                LogMiddleware::class,
            ],
            'extra'           => [],
            'proxy'           => [
                'switch' => false,
                'http'   => '127.0.0.1:8888',
                'https'  => '127.0.0.1:8888'
            ]
        ],
    ]
];