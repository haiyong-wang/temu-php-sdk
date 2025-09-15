<?php

declare(strict_types=1);

namespace Lensen\Temu;

use Exewen\Http\Middleware\LogMiddleware;
use Lensen\Temu\Constants\TemuEnum;
use Lensen\Temu\Middleware\AuthMiddleware;

class ConfigRegister
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                Contract\AuthInterface::class      => Services\AuthService::class,
                Contract\OrderInterface::class      => Services\OrderService::class,
                Contract\ShippingInterface::class      => Services\ShippingService::class,
            ],

            'temu' => [
                TemuEnum::CHANNEL_API        => TemuEnum::CHANNEL_API,
                TemuEnum::CHANNEL_DETAIL_API => TemuEnum::CHANNEL_DETAIL_API,
            ],

            'http' => [
                'channels' => [
                    TemuEnum::CHANNEL_API        => [
                        'verify'          => false,
                        'ssl'             => false,
                        'host'            => '3.123.72.134',
                        'port'            => 9090,
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
                    TemuEnum::CHANNEL_DETAIL_API => [
                        'verify'          => false,
                        'ssl'             => false,
                        'host'            => '3.123.72.134',
                        'port'            => 9090,
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
            ]


        ];
    }
}
